<?php

namespace App\Http\Controllers\produtos;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportProdutosRequest;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\CategoriaProduto;
use App\Models\DocumentoItem;
use App\Models\EstoqueSaldo;
use App\Models\Produto;
use App\Models\ProdutoPreco;
use App\Models\TabelaPreco;
use App\Models\UnidadeMedida;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProdutoController extends Controller
{
    public function index(Request $request): View
    {
        $query = $this->buildIndexQuery($request);

        $produtos = $query->orderByDesc('id')->paginate(15)->withQueryString();
        $consumoMap = $this->consumoDiarioMap($produtos->getCollection()->pluck('id')->all());
        $produtos->getCollection()->transform(fn (Produto $produto) => $this->enriquecerIndicadores($produto, $consumoMap));

        $cards = [
            'total' => Produto::count(),
            'ativos' => Produto::where('ativo', true)->count(),
            'baixo_estoque' => EstoqueSaldo::whereColumn('quantidade_atual', '<=', 'estoque_minimo')->count(),
            'com_preco' => ProdutoPreco::where('ativo', true)->distinct('produto_id')->count('produto_id'),
            'margem_media_ref' => (float) ProdutoPreco::query()
                ->where('ativo', true)
                ->where('preco', '>', 0)
                ->where(function (Builder $q) {
                    $q->whereNull('vigencia_fim')->orWhere('vigencia_fim', '>=', now());
                })
                ->avg(DB::raw('((preco - COALESCE(custo_referencia, 0)) / preco) * 100')) ?: 0,
            'cobertura_media_dias' => $this->coberturaMediaDiasGlobal(),
        ];

        return view('content.produtos.index', [
            'produtos' => $produtos,
            'categorias' => CategoriaProduto::where('ativo', true)->orderBy('nome')->get(),
            'filtros' => $request->only(['busca', 'categoria_id', 'ativo', 'baixo_estoque']),
            'cards' => $cards,
        ]);
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $produtos = $this->buildIndexQuery($request)->orderByDesc('id')->get();
        $consumoMap = $this->consumoDiarioMap($produtos->pluck('id')->all());
        $filename = 'produtos_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        return response()->streamDownload(function () use ($produtos, $consumoMap): void {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'ID',
                'SKU',
                'Nome',
                'Categoria',
                'Unidade',
                'Preco Atual',
                'Custo Ref',
                'Margem Ref (%)',
                'Estoque Atual',
                'Estoque Minimo',
                'Consumo Diario 30d',
                'Cobertura (dias)',
                'Status',
            ], ';');

            foreach ($produtos as $produto) {
                $produto = $this->enriquecerIndicadores($produto, $consumoMap);
                $saldo = $produto->estoqueSaldo;

                fputcsv($handle, [
                    $produto->id,
                    $produto->sku,
                    $produto->nome,
                    $produto->categoria?->nome ?? '',
                    $produto->unidadePrincipal?->sigla ?? '',
                    number_format((float) ($produto->preco_venda_atual ?? 0), 2, '.', ''),
                    number_format((float) ($produto->custo_ref_atual ?? 0), 2, '.', ''),
                    number_format((float) ($produto->margem_ref_percentual ?? 0), 2, '.', ''),
                    number_format((float) ($saldo->quantidade_atual ?? 0), 3, '.', ''),
                    number_format((float) ($saldo->estoque_minimo ?? 0), 3, '.', ''),
                    number_format((float) ($produto->consumo_diario_30 ?? 0), 3, '.', ''),
                    $produto->cobertura_dias !== null ? number_format((float) $produto->cobertura_dias, 1, '.', '') : '',
                    $produto->ativo ? 'ATIVO' : 'INATIVO',
                ], ';');
            }

            fclose($handle);
        }, $filename, $headers);
    }

    public function create(): View
    {
        return view('content.produtos.create', [
            'produto' => new Produto([
                'ativo' => true,
                'permite_venda' => true,
                'permite_compra' => true,
                'controla_lote' => false,
                'controla_validade' => false,
            ]),
            'categorias' => CategoriaProduto::where('ativo', true)->orderBy('nome')->get(),
            'unidades' => UnidadeMedida::where('ativo', true)->orderBy('sigla')->get(),
            'tabelasPreco' => TabelaPreco::where('ativo', true)->orderBy('prioridade')->orderBy('nome')->get(),
            'estoqueMinimo' => 0,
            'preco' => [
                'tabela_preco_id' => TabelaPreco::where('codigo', 'VAREJO')->value('id'),
                'preco_custo' => 0,
                'preco_venda' => 0,
            ],
        ]);
    }

    public function store(StoreProdutoRequest $request): RedirectResponse
    {
        $payload = $this->sanitizePayload($request->validated());

        DB::transaction(function () use ($payload) {
            $produto = Produto::create($payload['produto']);

            EstoqueSaldo::create([
                'produto_id' => $produto->id,
                'quantidade_atual' => 0,
                'estoque_minimo' => $payload['estoque_minimo'],
                'updated_at' => now(),
            ]);

            ProdutoPreco::create([
                'produto_id' => $produto->id,
                'tabela_preco_id' => $payload['preco']['tabela_preco_id'],
                'preco' => $payload['preco']['preco_venda'],
                'custo_referencia' => $payload['preco']['preco_custo'],
                'margem_percentual' => $this->calcularMargem(
                    $payload['preco']['preco_custo'],
                    $payload['preco']['preco_venda']
                ),
                'vigencia_inicio' => now(),
                'ativo' => true,
            ]);
        });

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso.');
    }

    public function show(Produto $produto): View
    {
        $produto->load([
            'categoria',
            'unidadePrincipal',
            'estoqueSaldo',
            'precos.tabelaPreco',
        ]);

        return view('content.produtos.show', compact('produto'));
    }

    public function edit(Produto $produto): View
    {
        $produto->load(['estoqueSaldo']);

        $precoAtual = ProdutoPreco::where('produto_id', $produto->id)
            ->where('ativo', true)
            ->where(function (Builder $q) {
                $q->whereNull('vigencia_fim')->orWhere('vigencia_fim', '>=', now());
            })
            ->orderByDesc('vigencia_inicio')
            ->first();

        return view('content.produtos.edit', [
            'produto' => $produto,
            'categorias' => CategoriaProduto::where('ativo', true)->orderBy('nome')->get(),
            'unidades' => UnidadeMedida::where('ativo', true)->orderBy('sigla')->get(),
            'tabelasPreco' => TabelaPreco::where('ativo', true)->orderBy('prioridade')->orderBy('nome')->get(),
            'estoqueMinimo' => (float) ($produto->estoqueSaldo->estoque_minimo ?? 0),
            'preco' => [
                'tabela_preco_id' => $precoAtual?->tabela_preco_id ?: TabelaPreco::where('codigo', 'VAREJO')->value('id'),
                'preco_custo' => (float) ($precoAtual?->custo_referencia ?? 0),
                'preco_venda' => (float) ($precoAtual?->preco ?? 0),
            ],
        ]);
    }

    public function update(UpdateProdutoRequest $request, Produto $produto): RedirectResponse
    {
        $payload = $this->sanitizePayload($request->validated());

        DB::transaction(function () use ($produto, $payload) {
            $produto->update($payload['produto']);

            EstoqueSaldo::updateOrCreate(
                ['produto_id' => $produto->id],
                [
                    'estoque_minimo' => $payload['estoque_minimo'],
                    'updated_at' => now(),
                ]
            );

            $precoAtual = ProdutoPreco::where('produto_id', $produto->id)
                ->where('tabela_preco_id', $payload['preco']['tabela_preco_id'])
                ->where('ativo', true)
                ->whereNull('vigencia_fim')
                ->orderByDesc('id')
                ->first();

            if ($precoAtual) {
                $precoAtual->update([
                    'preco' => $payload['preco']['preco_venda'],
                    'custo_referencia' => $payload['preco']['preco_custo'],
                    'margem_percentual' => $this->calcularMargem(
                        $payload['preco']['preco_custo'],
                        $payload['preco']['preco_venda']
                    ),
                ]);
            } else {
                ProdutoPreco::create([
                    'produto_id' => $produto->id,
                    'tabela_preco_id' => $payload['preco']['tabela_preco_id'],
                    'preco' => $payload['preco']['preco_venda'],
                    'custo_referencia' => $payload['preco']['preco_custo'],
                    'margem_percentual' => $this->calcularMargem(
                        $payload['preco']['preco_custo'],
                        $payload['preco']['preco_venda']
                    ),
                    'vigencia_inicio' => now(),
                    'ativo' => true,
                ]);
            }
        });

        return redirect()->route('produtos.show', $produto)->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto): RedirectResponse
    {
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto removido com sucesso.');
    }

    public function import(ImportProdutosRequest $request): RedirectResponse
    {
        $file = $request->file('arquivo');
        $rows = $this->parseImportRows($file);

        if (count($rows) === 0) {
            return redirect()->route('produtos.index')->with('error', 'Arquivo sem dados para importacao.');
        }

        $categoriaId = (int) (CategoriaProduto::where('ativo', true)->value('id') ?: CategoriaProduto::create(['nome' => 'Geral', 'ativo' => true])->id);
        $unidadeId = (int) (UnidadeMedida::where('ativo', true)->where('sigla', 'UN')->value('id') ?: UnidadeMedida::create([
            'sigla' => 'UN',
            'nome' => 'Unidade',
            'casas_decimais' => 0,
            'ativo' => true,
        ])->id);
        $tabelaPrecoId = (int) (TabelaPreco::where('codigo', 'VAREJO')->value('id') ?: TabelaPreco::create([
            'nome' => 'Tabela Varejo',
            'codigo' => 'VAREJO',
            'tipo' => 'VAREJO',
            'ativo' => true,
            'prioridade' => 0,
        ])->id);

        $created = 0;
        $updated = 0;
        $ignored = 0;

        foreach ($rows as $index => $row) {
            $nome = trim((string) ($row['nome'] ?? ''));
            $ean = preg_replace('/\D/', '', (string) ($row['ean'] ?? ''));
            $marca = trim((string) ($row['marca'] ?? ''));
            $custo = $this->toDecimal($row['custo'] ?? 0);
            $venda = $this->toDecimal($row['preco_venda'] ?? 0);

            if ($nome === '' || $venda < 0 || $custo < 0) {
                $ignored++;
                continue;
            }

            if ($venda < $custo) {
                $venda = $custo;
            }

            DB::transaction(function () use (
                &$created,
                &$updated,
                $nome,
                $ean,
                $marca,
                $custo,
                $venda,
                $categoriaId,
                $unidadeId,
                $tabelaPrecoId
            ) {
                $produto = null;

                if ($ean !== '') {
                    $produto = Produto::where('codigo_barras', $ean)->first();
                }

                if (!$produto) {
                    $produto = Produto::create([
                        'sku' => $this->generateImportSku($nome),
                        'nome' => $nome,
                        'descricao' => null,
                        'codigo_barras' => $ean !== '' ? $ean : null,
                        'categoria_id' => $categoriaId,
                        'unidade_principal_id' => $unidadeId,
                        'controla_lote' => false,
                        'controla_validade' => false,
                        'ativo' => true,
                        'permite_venda' => true,
                        'permite_compra' => true,
                        'marca' => $marca !== '' ? $marca : null,
                    ]);

                    EstoqueSaldo::create([
                        'produto_id' => $produto->id,
                        'quantidade_atual' => 0,
                        'estoque_minimo' => 0,
                        'updated_at' => now(),
                    ]);

                    $created++;
                } else {
                    $produto->update([
                        'nome' => $nome,
                        'marca' => $marca !== '' ? $marca : $produto->marca,
                        'categoria_id' => $produto->categoria_id ?: $categoriaId,
                        'unidade_principal_id' => $produto->unidade_principal_id ?: $unidadeId,
                    ]);

                    EstoqueSaldo::firstOrCreate(
                        ['produto_id' => $produto->id],
                        ['quantidade_atual' => 0, 'estoque_minimo' => 0, 'updated_at' => now()]
                    );

                    $updated++;
                }

                $precoAtual = ProdutoPreco::where('produto_id', $produto->id)
                    ->where('tabela_preco_id', $tabelaPrecoId)
                    ->where('ativo', true)
                    ->whereNull('vigencia_fim')
                    ->orderByDesc('id')
                    ->first();

                if ($precoAtual) {
                    $precoAtual->update([
                        'preco' => $venda,
                        'custo_referencia' => $custo,
                        'margem_percentual' => $this->calcularMargem($custo, $venda),
                    ]);
                } else {
                    ProdutoPreco::create([
                        'produto_id' => $produto->id,
                        'tabela_preco_id' => $tabelaPrecoId,
                        'preco' => $venda,
                        'custo_referencia' => $custo,
                        'margem_percentual' => $this->calcularMargem($custo, $venda),
                        'vigencia_inicio' => now(),
                        'ativo' => true,
                    ]);
                }
            });
        }

        return redirect()->route('produtos.index')->with(
            'success',
            "Importacao concluida. Criados: {$created} | Atualizados: {$updated} | Ignorados: {$ignored}"
        );
    }

    public function importTemplate(): StreamedResponse
    {
        $filename = 'template-importacao-produtos.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');

            // BOM para abrir acentuacao corretamente no Excel
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, ['nome', 'ean', 'marca', 'custo', 'preco_venda'], ';');
            fputcsv($handle, ['Tinta Acrilica Fosca Branca 18L', '7891234567890', 'Marca Exemplo', '120.50', '169.90'], ';');

            fclose($handle);
        }, $filename, $headers);
    }

    private function sanitizePayload(array $data): array
    {
        $nullableFields = [
            'descricao',
            'codigo_barras',
            'marca',
            'ncm',
            'cest',
            'observacoes',
        ];

        foreach ($nullableFields as $field) {
            if (array_key_exists($field, $data) && $data[$field] === '') {
                $data[$field] = null;
            }
        }

        return [
            'produto' => [
                'sku' => $data['sku'],
                'nome' => $data['nome'],
                'descricao' => $data['descricao'] ?? null,
                'codigo_barras' => $data['codigo_barras'] ?? null,
                'categoria_id' => $data['categoria_id'],
                'unidade_principal_id' => $data['unidade_principal_id'],
                'controla_lote' => (bool) ($data['controla_lote'] ?? false),
                'controla_validade' => (bool) ($data['controla_validade'] ?? false),
                'ativo' => (bool) ($data['ativo'] ?? true),
                'permite_venda' => (bool) ($data['permite_venda'] ?? true),
                'permite_compra' => (bool) ($data['permite_compra'] ?? true),
                'ncm' => $data['ncm'] ?? null,
                'cest' => $data['cest'] ?? null,
                'marca' => $data['marca'] ?? null,
                'observacoes' => $data['observacoes'] ?? null,
            ],
            'estoque_minimo' => (float) $data['estoque_minimo'],
            'preco' => [
                'tabela_preco_id' => (int) $data['tabela_preco_id'],
                'preco_custo' => (float) $data['preco_custo'],
                'preco_venda' => (float) $data['preco_venda'],
            ],
        ];
    }

    private function buildIndexQuery(Request $request): Builder
    {
        $query = Produto::query()
            ->with(['categoria', 'unidadePrincipal', 'estoqueSaldo'])
            ->withMax(['precos as preco_venda_atual' => function (Builder $q) {
                $q->where('ativo', true)->where(function (Builder $inner) {
                    $inner->whereNull('vigencia_fim')->orWhere('vigencia_fim', '>=', now());
                });
            }], 'preco')
            ->withMax(['precos as custo_ref_atual' => function (Builder $q) {
                $q->where('ativo', true)->where(function (Builder $inner) {
                    $inner->whereNull('vigencia_fim')->orWhere('vigencia_fim', '>=', now());
                });
            }], 'custo_referencia');

        if ($request->filled('busca')) {
            $busca = trim((string) $request->string('busca'));
            $query->where(function (Builder $q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                    ->orWhere('sku', 'like', "%{$busca}%")
                    ->orWhere('codigo_barras', 'like', "%{$busca}%");
            });
        }

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', (int) $request->integer('categoria_id'));
        }

        if ($request->filled('ativo')) {
            $query->where('ativo', (bool) $request->integer('ativo'));
        }

        if ($request->filled('baixo_estoque') && $request->integer('baixo_estoque') === 1) {
            $query->whereHas('estoqueSaldo', function (Builder $q) {
                $q->whereColumn('quantidade_atual', '<=', 'estoque_minimo');
            });
        }

        return $query;
    }

    private function consumoDiarioMap(array $produtoIds): array
    {
        if (empty($produtoIds)) {
            return [];
        }

        $inicio = now()->subDays(30);

        return DocumentoItem::query()
            ->selectRaw('documento_itens.produto_id, SUM(documento_itens.quantidade) as total_qtd')
            ->join('documentos_comerciais', 'documentos_comerciais.id', '=', 'documento_itens.documento_id')
            ->whereIn('documento_itens.produto_id', $produtoIds)
            ->where('documentos_comerciais.status', 'FATURADO')
            ->whereDate('documentos_comerciais.data_emissao', '>=', $inicio->toDateString())
            ->groupBy('documento_itens.produto_id')
            ->pluck('total_qtd', 'documento_itens.produto_id')
            ->map(fn ($qtd) => round(((float) $qtd) / 30, 3))
            ->all();
    }

    private function enriquecerIndicadores(Produto $produto, array $consumoMap): Produto
    {
        $preco = (float) ($produto->preco_venda_atual ?? 0);
        $custo = (float) ($produto->custo_ref_atual ?? 0);
        $margem = $preco > 0 ? round((($preco - $custo) / $preco) * 100, 2) : 0;

        $estoqueAtual = (float) ($produto->estoqueSaldo->quantidade_atual ?? 0);
        $consumoDiario = (float) ($consumoMap[$produto->id] ?? 0);
        $cobertura = $consumoDiario > 0 ? round($estoqueAtual / $consumoDiario, 1) : null;

        $produto->setAttribute('margem_ref_percentual', $margem);
        $produto->setAttribute('consumo_diario_30', $consumoDiario);
        $produto->setAttribute('cobertura_dias', $cobertura);

        return $produto;
    }

    private function coberturaMediaDiasGlobal(): float
    {
        $estoqueTotal = (float) EstoqueSaldo::query()->sum('quantidade_atual');
        $vendas30 = (float) DocumentoItem::query()
            ->join('documentos_comerciais', 'documentos_comerciais.id', '=', 'documento_itens.documento_id')
            ->where('documentos_comerciais.status', 'FATURADO')
            ->whereDate('documentos_comerciais.data_emissao', '>=', now()->subDays(30)->toDateString())
            ->sum('documento_itens.quantidade');

        if ($vendas30 <= 0) {
            return 0;
        }

        $consumoDiario = $vendas30 / 30;
        return $consumoDiario > 0 ? round($estoqueTotal / $consumoDiario, 1) : 0;
    }

    private function calcularMargem(float $custo, float $venda): ?float
    {
        if ($custo <= 0) {
            return null;
        }

        return round((($venda - $custo) / $custo) * 100, 4);
    }

    /**
     * @return array<int, array{nome:string,ean:string,marca:string,custo:string,preco_venda:string}>
     */
    private function parseImportRows(UploadedFile $file): array
    {
        $extension = strtolower((string) $file->getClientOriginalExtension());

        if ($extension === 'csv' || $extension === 'txt') {
            return $this->parseCsv($file->getRealPath());
        }

        return $this->parseXlsx($file->getRealPath());
    }

    private function parseCsv(string $path): array
    {
        $peekHandle = fopen($path, 'r');
        $firstLine = $peekHandle ? (string) fgets($peekHandle) : '';
        if (is_resource($peekHandle)) {
            fclose($peekHandle);
        }
        $delimiter = substr_count($firstLine, ';') > substr_count($firstLine, ',') ? ';' : ',';

        $handle = fopen($path, 'r');
        if ($handle === false) {
            return [];
        }

        $rows = [];
        $headers = [];
        $line = 0;

        while (($data = fgetcsv($handle, 0, $delimiter)) !== false) {
            $line++;
            if ($line === 1) {
                $headers = $this->normalizeHeaders($data);
                continue;
            }

            $rows[] = $this->mapRowToFields($headers, $data);
        }

        fclose($handle);

        return $rows;
    }

    private function parseXlsx(string $path): array
    {
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rowsRaw = $sheet->toArray(null, true, true, false);

        if (count($rowsRaw) <= 1) {
            return [];
        }

        $headers = $this->normalizeHeaders($rowsRaw[0]);
        $rows = [];

        foreach (array_slice($rowsRaw, 1) as $row) {
            $rows[] = $this->mapRowToFields($headers, $row);
        }

        return $rows;
    }

    private function normalizeHeaders(array $headers): array
    {
        return array_map(function ($header) {
            $value = Str::of((string) $header)
                ->lower()
                ->ascii()
                ->replace([' ', '-', '.'], '_')
                ->replace(['(', ')'], '')
                ->trim()
                ->value();

            return match ($value) {
                'codigo_barras', 'cod_barras', 'ean13', 'ean_13' => 'ean',
                'preco', 'preco_venda_r', 'preco_de_venda' => 'preco_venda',
                default => $value,
            };
        }, $headers);
    }

    private function mapRowToFields(array $headers, array $row): array
    {
        $mapped = array_combine($headers, $row) ?: [];

        return [
            'nome' => (string) ($mapped['nome'] ?? ''),
            'ean' => (string) ($mapped['ean'] ?? $mapped['codigo_barras'] ?? ''),
            'marca' => (string) ($mapped['marca'] ?? ''),
            'custo' => (string) ($mapped['custo'] ?? $mapped['preco_custo'] ?? '0'),
            'preco_venda' => (string) ($mapped['preco_venda'] ?? $mapped['preco'] ?? '0'),
        ];
    }

    private function generateImportSku(string $nome): string
    {
        $prefix = Str::upper(Str::substr(preg_replace('/[^A-Za-z0-9]/', '', Str::ascii($nome)), 0, 6));
        if ($prefix === '') {
            $prefix = 'PROD';
        }

        for ($i = 1; $i <= 999999; $i++) {
            $sku = sprintf('IMP-%s-%06d', $prefix, $i);
            if (!Produto::where('sku', $sku)->exists()) {
                return $sku;
            }
        }

        return 'IMP-' . Str::upper(Str::random(10));
    }

    private function toDecimal(mixed $value): float
    {
        $raw = preg_replace('/[^\d,.-]/', '', (string) $value);
        if ($raw === '' || $raw === null) {
            return 0.0;
        }

        $hasComma = str_contains($raw, ',');
        $hasDot = str_contains($raw, '.');

        if ($hasComma && $hasDot) {
            $normalized = str_replace('.', '', $raw);
            $normalized = str_replace(',', '.', $normalized);
            return (float) $normalized;
        }

        if ($hasComma) {
            return (float) str_replace(',', '.', $raw);
        }

        return (float) $raw;
    }
}
