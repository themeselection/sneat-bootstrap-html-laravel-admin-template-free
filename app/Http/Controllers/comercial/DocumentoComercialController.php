<?php

namespace App\Http\Controllers\comercial;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportVendasLegadoPdfRequest;
use App\Http\Requests\StoreDocumentoComercialRequest;
use App\Http\Requests\UpdateDocumentoComercialRequest;
use App\Models\Cliente;
use App\Models\DocumentoComercial;
use App\Models\Filial;
use App\Models\Produto;
use App\Models\ProdutoPreco;
use App\Models\TabelaPreco;
use App\Services\Comercial\DocumentoComercialService;
use App\Services\Comercial\LegacyVendaImportService;
use App\Services\Comercial\LegacyVendaPdfParser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Throwable;
use Illuminate\View\View;

class DocumentoComercialController extends Controller
{
    public function __construct(private readonly DocumentoComercialService $service)
    {
    }

    public function index(Request $request): View
    {
        $query = $this->buildIndexQuery($request);

        $documentos = $query->paginate(20)->withQueryString();

        $cards = [
            'total' => DocumentoComercial::count(),
            'orcamentos_pendentes' => DocumentoComercial::where('tipo', 'ORCAMENTO')->where('status', 'PENDENTE')->count(),
            'aguardando_faturamento' => DocumentoComercial::whereIn('tipo', ['PEDIDO', 'VENDA'])->where('status', 'AGUARDANDO_FATURAMENTO')->count(),
            'faturados_mes' => DocumentoComercial::where('status', 'FATURADO')->whereMonth('data_emissao', now()->month)->count(),
        ];

        return view('content.comercial.documentos.index', [
            'documentos' => $documentos,
            'clientes' => Cliente::orderBy('nome')->get(['id', 'nome']),
            'tipos' => ['ORCAMENTO', 'PREVENDA', 'PEDIDO', 'VENDA'],
            'statusList' => [
                'RASCUNHO',
                'PENDENTE',
                'AGUARDANDO_PAGAMENTO',
                'EM_SEPARACAO',
                'AGUARDANDO_FATURAMENTO',
                'CONCLUIDO',
                'FATURADO',
                'CANCELADO',
            ],
            'cards' => $cards,
            'filtros' => $request->only(['tipo', 'status', 'cliente_id', 'numero', 'data_inicio', 'data_fim']),
        ]);
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $documentos = $this->buildIndexQuery($request)->get();
        $filename = 'documentos_comerciais_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        return response()->streamDownload(function () use ($documentos): void {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'ID',
                'Numero',
                'Tipo',
                'Status',
                'Cliente',
                'Data Emissao',
                'Subtotal',
                'Desconto',
                'Acrescimo',
                'Impostos',
                'Total Liquido',
            ], ';');

            foreach ($documentos as $documento) {
                fputcsv($handle, [
                    $documento->id,
                    $documento->numero,
                    $documento->tipo,
                    $documento->status,
                    $documento->cliente->nome ?? '',
                    optional($documento->data_emissao)->format('Y-m-d H:i:s'),
                    number_format((float) $documento->subtotal, 2, '.', ''),
                    number_format((float) $documento->desconto_total, 2, '.', ''),
                    number_format((float) $documento->acrescimo_total, 2, '.', ''),
                    number_format((float) $documento->impostos_total, 2, '.', ''),
                    number_format((float) $documento->total_liquido, 2, '.', ''),
                ], ';');
            }

            fclose($handle);
        }, $filename, $headers);
    }

    public function create(Request $request): View
    {
        $tipo = (string) $request->string('tipo', 'ORCAMENTO');

        return view('content.comercial.documentos.create', [
            'documento' => new DocumentoComercial([
                'tipo' => $tipo,
                'status' => 'PENDENTE',
                'desconto_total' => 0,
                'acrescimo_total' => 0,
                'impostos_total' => 0,
            ]),
            'filiais' => Filial::where('ativa', true)->orderBy('nome')->get(['id', 'nome']),
            'tabelasPreco' => TabelaPreco::where('ativo', true)->orderBy('prioridade')->orderBy('nome')->get(['id', 'nome', 'codigo']),
            'tipos' => ['ORCAMENTO', 'PREVENDA', 'PEDIDO', 'VENDA'],
            'statusOptionsByTipo' => DocumentoComercialService::STATUS_POR_TIPO,
            'regrasEdicao' => [
                'pode_editar' => true,
                'permite_alterar_itens' => true,
                'permite_alterar_cabecalho' => true,
                'motivo' => null,
            ],
            'isEdit' => false,
        ]);
    }

    public function store(StoreDocumentoComercialRequest $request): RedirectResponse
    {
        $documento = $this->service->create($request->validated(), $request->user());

        return redirect()->route('documentos-comerciais.show', $documento)->with('success', 'Documento criado com sucesso.');
    }

    public function show(DocumentoComercial $documento): View
    {
        $documento = $documento;
        $regrasEdicao = $this->service->regrasEdicao($documento);
        $usuario = request()->user();
        $acoesFluxo = $this->service->acoesFluxoDisponiveis($documento);

        $documento->load([
            'cliente',
            'vendedor',
            'operador',
            'filial',
            'origem',
            'itens.produto',
            'itens.reserva',
            'eventos.usuario',
            'pagamentos',
            'faturamento',
        ]);

        return view('content.comercial.documentos.show', [
            'documento' => $documento,
            'analise' => $this->buildAnalise($documento),
            'regrasEdicao' => $regrasEdicao,
            'podeGerenciarCancelamento' => $usuario?->hasPermission('vendas.documentos.cancelar') ?? false,
            'acoesFluxo' => $acoesFluxo,
        ]);
    }

    public function edit(DocumentoComercial $documento): View|RedirectResponse
    {
        $documento = $documento;
        $regrasEdicao = $this->service->regrasEdicao($documento);
        if (!$regrasEdicao['pode_editar']) {
            return redirect()
                ->route('documentos-comerciais.show', $documento)
                ->with('error', $regrasEdicao['motivo'] ?? 'Documento nao pode ser alterado nesta etapa.');
        }

        $documento->load(['itens.produto', 'cliente']);

        return view('content.comercial.documentos.edit', [
            'documento' => $documento,
            'filiais' => Filial::where('ativa', true)->orderBy('nome')->get(['id', 'nome']),
            'tabelasPreco' => TabelaPreco::where('ativo', true)->orderBy('prioridade')->orderBy('nome')->get(['id', 'nome', 'codigo']),
            'tipos' => ['ORCAMENTO', 'PREVENDA', 'PEDIDO', 'VENDA'],
            'statusOptionsByTipo' => DocumentoComercialService::STATUS_POR_TIPO,
            'regrasEdicao' => $regrasEdicao,
            'isEdit' => true,
        ]);
    }

    public function update(UpdateDocumentoComercialRequest $request, DocumentoComercial $documento): RedirectResponse
    {
        $documento = $this->service->update($documento, $request->validated(), $request->user());

        return redirect()->route('documentos-comerciais.show', $documento)->with('success', 'Documento atualizado com sucesso.');
    }

    public function destroy(DocumentoComercial $documento): RedirectResponse
    {
        $this->assertPermission('vendas.documentos.cancelar', 'Voce nao possui permissao para cancelar documentos.');

        $data = request()->validate([
            'motivo_cancelamento' => ['required', 'string', 'min:5', 'max:500'],
        ], [
            'motivo_cancelamento.required' => 'Informe o motivo do cancelamento.',
            'motivo_cancelamento.min' => 'Motivo do cancelamento muito curto.',
        ]);

        $this->service->cancelar($documento, request()->user(), (string) $data['motivo_cancelamento']);

        return redirect()->route('documentos-comerciais.show', $documento)->with('success', 'Documento cancelado com sucesso.');
    }

    public function reabrir(DocumentoComercial $documento): RedirectResponse
    {
        $this->assertPermission('vendas.documentos.cancelar', 'Voce nao possui permissao para reabrir documentos.');

        $data = request()->validate([
            'motivo_reabertura' => ['required', 'string', 'min:5', 'max:500'],
        ], [
            'motivo_reabertura.required' => 'Informe o motivo da reabertura.',
            'motivo_reabertura.min' => 'Motivo da reabertura muito curto.',
        ]);

        $documento = $this->service->reabrir($documento, request()->user(), (string) $data['motivo_reabertura']);

        return redirect()->route('documentos-comerciais.show', $documento)->with('success', 'Documento reaberto com sucesso.');
    }

    private function assertPermission(string $permission, string $message): void
    {
        $user = request()->user();
        if (!$user || !$user->hasPermission($permission)) {
            abort(403, $message);
        }
    }

    public function converterPedido(DocumentoComercial $documento): RedirectResponse
    {
        $pedido = $this->service->converterOrcamentoParaPedido($documento, request()->user());

        return redirect()->route('documentos-comerciais.show', $pedido)->with('success', 'Orcamento convertido em pedido.');
    }

    public function converterVenda(DocumentoComercial $documento): RedirectResponse
    {
        $venda = $this->service->converterPedidoParaVenda($documento, request()->user());

        return redirect()->route('documentos-comerciais.show', $venda)->with('success', 'Pedido convertido em venda.');
    }

    public function faturar(DocumentoComercial $documento): RedirectResponse
    {
        $documento = $this->service->faturar($documento, request()->user());

        return redirect()->route('documentos-comerciais.show', $documento)->with('success', 'Faturamento concluido com sucesso.');
    }

    public function analise(DocumentoComercial $documento): View
    {
        $documento = $documento->load(['itens.produto']);

        return view('content.comercial.documentos.analise', [
            'documento' => $documento,
            'analise' => $this->buildAnalise($documento),
        ]);
    }

    public function exportAnaliseCsv(DocumentoComercial $documento): StreamedResponse
    {
        $documento = $documento->load(['itens.produto']);
        $analise = $this->buildAnalise($documento);
        $filename = 'analise_' . $documento->numero . '_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        return response()->streamDownload(function () use ($analise): void {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'Item',
                'Quantidade',
                'Receita Bruta',
                'Desconto Rateado',
                'Acrescimo Rateado',
                'Imposto Rateado',
                'Custo Ref Unitario',
                'Custo Total',
                'Receita Liquida',
                'Margem',
                'Margem (%)',
            ], ';');

            foreach ($analise['itens'] as $row) {
                fputcsv($handle, [
                    $row['item']->descricao,
                    number_format((float) $row['item']->quantidade, 3, '.', ''),
                    number_format((float) $row['receita_bruta'], 2, '.', ''),
                    number_format((float) $row['desconto_rateado'], 2, '.', ''),
                    number_format((float) $row['acrescimo_rateado'], 2, '.', ''),
                    number_format((float) $row['imposto_rateado'], 2, '.', ''),
                    number_format((float) $row['custo_ref_unitario'], 2, '.', ''),
                    number_format((float) $row['custo_total'], 2, '.', ''),
                    number_format((float) $row['receita'], 2, '.', ''),
                    number_format((float) $row['margem'], 2, '.', ''),
                    number_format((float) $row['margem_percentual'], 2, '.', ''),
                ], ';');
            }

            fclose($handle);
        }, $filename, $headers);
    }

    public function buscarProdutos(Request $request): JsonResponse
    {
        $termo = trim((string) $request->string('termo'));
        if (mb_strlen($termo) < 2) {
            return response()->json(['produtos' => []]);
        }

        $produtos = Produto::query()
            ->with('unidadePrincipal:id,sigla')
            ->where('ativo', true)
            ->where('permite_venda', true)
            ->where(function ($q) use ($termo) {
                $q->where('nome', 'like', "%{$termo}%")
                    ->orWhere('sku', 'like', "%{$termo}%")
                    ->orWhere('codigo_barras', 'like', "%{$termo}%");
            })
            ->orderByRaw('nome LIKE ? DESC', ["{$termo}%"])
            ->orderBy('nome')
            ->limit(20)
            ->get(['id', 'nome', 'sku', 'codigo_barras', 'unidade_principal_id']);

        $precos = ProdutoPreco::query()
            ->whereIn('produto_id', $produtos->pluck('id'))
            ->where('ativo', true)
            ->orderByDesc('vigencia_inicio')
            ->get()
            ->groupBy('produto_id')
            ->map(fn ($items) => (float) ($items->first()->preco ?? 0));

        return response()->json([
            'produtos' => $produtos->map(fn ($p) => [
                'id' => $p->id,
                'nome' => $p->nome,
                'sku' => $p->sku,
                'ean' => $p->codigo_barras,
                'unidade' => $p->unidadePrincipal?->sigla ?? 'UN',
                'preco' => (float) ($precos[$p->id] ?? 0),
            ])->values(),
        ]);
    }

    public function buscarClientes(Request $request): JsonResponse
    {
        $termo = trim((string) $request->string('termo'));
        if (mb_strlen($termo) < 2) {
            return response()->json(['clientes' => []]);
        }

        $clientes = Cliente::query()
            ->where('ativo', true)
            ->where(function ($q) use ($termo) {
                $q->where('nome', 'like', "%{$termo}%")
                    ->orWhere('cpf_cnpj', 'like', "%{$termo}%")
                    ->orWhere('telefone', 'like', "%{$termo}%")
                    ->orWhere('email', 'like', "%{$termo}%");
            })
            ->orderByRaw('nome LIKE ? DESC', ["{$termo}%"])
            ->orderBy('nome')
            ->limit(20)
            ->get(['id', 'nome', 'cpf_cnpj', 'telefone', 'email', 'tipo_pessoa']);

        return response()->json([
            'clientes' => $clientes->map(fn ($cliente) => [
                'id' => $cliente->id,
                'nome' => $cliente->nome,
                'cpf_cnpj' => $cliente->cpf_cnpj,
                'telefone' => $cliente->telefone,
                'email' => $cliente->email,
                'tipo_cliente' => $cliente->tipo_pessoa,
            ])->values(),
        ]);
    }

    public function pdv(): View
    {
        $produtos = Produto::query()
            ->with(['unidadePrincipal', 'estoqueSaldo'])
            ->where('ativo', true)
            ->where('permite_venda', true)
            ->orderBy('nome')
            ->get();

        $tabelaPrecoVarejoId = TabelaPreco::where('codigo', 'VAREJO')->value('id');
        $precos = ProdutoPreco::query()
            ->where('ativo', true)
            ->when($tabelaPrecoVarejoId, fn ($q) => $q->where('tabela_preco_id', $tabelaPrecoVarejoId))
            ->orderByDesc('vigencia_inicio')
            ->get()
            ->keyBy('produto_id');

        return view('content.comercial.pdv.index', [
            'clientes' => Cliente::orderBy('nome')->get(['id', 'nome', 'cpf_cnpj']),
            'produtos' => $produtos,
            'precos' => $precos,
        ]);
    }

    public function pdvFinalizar(StoreDocumentoComercialRequest $request): RedirectResponse
    {
        $payload = $request->validated();
        $payload['tipo'] = 'VENDA';
        $payload['status'] = 'AGUARDANDO_FATURAMENTO';

        $documento = $this->service->create($payload, $request->user());

        return redirect()->route('documentos-comerciais.show', $documento)->with('success', 'Venda registrada no PDV.');
    }

    public function importarPdfLegado(
        ImportVendasLegadoPdfRequest $request,
        LegacyVendaPdfParser $parser,
        LegacyVendaImportService $importService
    ): RedirectResponse {
        $arquivos = $this->normalizarArquivos($request);
        $inicio = microtime(true);
        $sucesso = [];
        $falhas = [];
        $ignorados = [];

        foreach ($arquivos as $arquivo) {
            try {
                $dados = $parser->parse($arquivo);
                $documento = $importService->importar($dados, $request->user());
                $sucesso[] = [
                    'arquivo' => $arquivo->getClientOriginalName(),
                    'numero' => $documento->numero,
                ];
            } catch (Throwable $e) {
                if ($this->isDuplicidadeImportacao($e)) {
                    $ignorados[] = [
                        'arquivo' => $arquivo->getClientOriginalName(),
                        'motivo' => $e->getMessage(),
                    ];
                    continue;
                }

                $falhas[] = [
                    'arquivo' => $arquivo->getClientOriginalName(),
                    'erro' => $e->getMessage(),
                ];
            }
        }

        $tempoMs = (int) round((microtime(true) - $inicio) * 1000);
        $total = count($arquivos);

        $redirect = redirect()->route('documentos-comerciais.index');

        if (count($sucesso) > 0) {
            $redirect->with('success', count($sucesso) . ' PDF(s) importado(s) como venda faturada.');
        }

        if (count($falhas) > 0) {
            $redirect->with(
                'error',
                count($falhas) . ' arquivo(s) nao foram importados. Veja os detalhes abaixo.'
            );
        }

        if (count($ignorados) > 0) {
            $redirect->with('warning', count($ignorados) . ' arquivo(s) ignorados (duplicidade).');
        }

        return $redirect->with('import_feedback', [
            'sucesso' => $sucesso,
            'falhas' => $falhas,
            'ignorados' => $ignorados,
            'stats' => [
                'total' => $total,
                'sucesso' => count($sucesso),
                'falhas' => count($falhas),
                'ignorados' => count($ignorados),
                'tempo_ms' => $tempoMs,
            ],
        ]);
    }

    /**
     * @return array<int, UploadedFile>
     */
    private function normalizarArquivos(Request $request): array
    {
        $arquivosUpload = Arr::flatten([
            $request->file('arquivos', []),
            $request->file('pasta_arquivos', []),
        ]);

        $arquivos = array_values(array_filter($arquivosUpload, function ($arquivo): bool {
            if (!$arquivo instanceof UploadedFile) {
                return false;
            }

            $mime = (string) $arquivo->getMimeType();
            $ext = strtolower((string) $arquivo->getClientOriginalExtension());

            return $mime === 'application/pdf' || $ext === 'pdf';
        }));

        $caminhoPasta = trim((string) $request->input('caminho_pasta'));
        if ($caminhoPasta !== '' && File::isDirectory($caminhoPasta)) {
            foreach ($this->buscarPdfsDaPasta($caminhoPasta) as $pdfPath) {
                $arquivos[] = new UploadedFile(
                    $pdfPath,
                    basename($pdfPath),
                    'application/pdf',
                    null,
                    true
                );
            }
        }

        return $arquivos;
    }

    /**
     * @return array<int, string>
     */
    private function buscarPdfsDaPasta(string $caminhoPasta): array
    {
        $arquivos = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($caminhoPasta, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }

            if (strtolower((string) $fileInfo->getExtension()) !== 'pdf') {
                continue;
            }

            $arquivos[] = $fileInfo->getPathname();
        }

        return $arquivos;
    }

    private function isDuplicidadeImportacao(Throwable $e): bool
    {
        $msg = mb_strtolower($e->getMessage());
        return str_contains($msg, 'ja importada') || str_contains($msg, 'duplic');
    }

    private function buildAnalise(DocumentoComercial $documento): array
    {
        $documento->loadMissing('itens.produto');

        $subtotalItens = (float) $documento->itens->sum('subtotal_bruto');
        $descontoTotal = (float) $documento->desconto_total;
        $acrescimoTotal = (float) $documento->acrescimo_total;
        $impostoTotal = (float) $documento->impostos_total;

        $itens = $documento->itens->map(function ($item) use ($subtotalItens, $descontoTotal, $acrescimoTotal, $impostoTotal) {
            $custoRef = (float) ProdutoPreco::query()
                ->where('produto_id', $item->produto_id)
                ->where('ativo', true)
                ->orderByDesc('vigencia_inicio')
                ->value('custo_referencia');

            $subtotalBrutoItem = (float) $item->subtotal_bruto;
            $pesoRateio = $subtotalItens > 0 ? ($subtotalBrutoItem / $subtotalItens) : 0;
            $descontoRateado = round($descontoTotal * $pesoRateio, 2);
            $acrescimoRateado = round($acrescimoTotal * $pesoRateio, 2);
            $impostoRateado = round($impostoTotal * $pesoRateio, 2);

            $receitaBruta = $subtotalBrutoItem;
            $receitaLiquida = round($receitaBruta - $descontoRateado + $acrescimoRateado + $impostoRateado, 2);
            $custoTotal = $custoRef * (float) $item->quantidade;
            $margem = $receitaLiquida - $custoTotal;
            $margemPercentual = $receitaLiquida > 0 ? round(($margem / $receitaLiquida) * 100, 2) : 0;

            return [
                'item' => $item,
                'peso_rateio' => $pesoRateio,
                'desconto_rateado' => $descontoRateado,
                'acrescimo_rateado' => $acrescimoRateado,
                'imposto_rateado' => $impostoRateado,
                'custo_ref_unitario' => $custoRef,
                'custo_total' => $custoTotal,
                'receita_bruta' => $receitaBruta,
                'receita' => $receitaLiquida,
                'margem' => $margem,
                'margem_percentual' => $margemPercentual,
            ];
        });

        return [
            'itens' => $itens,
            'subtotal_itens' => $subtotalItens,
            'desconto_rateado_total' => $descontoTotal,
            'acrescimo_rateado_total' => $acrescimoTotal,
            'imposto_rateado_total' => $impostoTotal,
            'total_receita' => (float) $documento->total_liquido,
            'total_custo_ref' => (float) $itens->sum('custo_total'),
            'total_margem' => (float) $itens->sum('margem'),
            'margem_percentual_total' => (float) ($documento->total_liquido > 0 ? round(($itens->sum('margem') / (float) $documento->total_liquido) * 100, 2) : 0),
        ];
    }

    private function buildIndexQuery(Request $request)
    {
        $query = DocumentoComercial::query()
            ->with(['cliente', 'vendedor', 'origem'])
            ->orderByDesc('id');

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->string('tipo'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('cliente_id')) {
            $query->where('cliente_id', (int) $request->integer('cliente_id'));
        }

        if ($request->filled('numero')) {
            $numero = trim((string) $request->string('numero'));
            $query->where('numero', 'like', "%{$numero}%");
        }

        if ($request->filled('data_inicio')) {
            $query->whereDate('data_emissao', '>=', $request->date('data_inicio'));
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('data_emissao', '<=', $request->date('data_fim'));
        }

        return $query;
    }
}
