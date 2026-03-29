<?php

namespace App\Services\Comercial;

use App\Models\CategoriaProduto;
use App\Models\Cliente;
use App\Models\ContaReceber;
use App\Models\DocumentoComercial;
use App\Models\DocumentoPagamento;
use App\Models\EstoqueSaldo;
use App\Models\Faturamento;
use App\Models\Filial;
use App\Models\Produto;
use App\Models\ProdutoPreco;
use App\Models\TabelaPreco;
use App\Models\UnidadeMedida;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LegacyVendaImportService
{
    public function __construct(private readonly DocumentoComercialService $documentoService)
    {
    }

    public function importar(array $dados, User $usuario): DocumentoComercial
    {
        return DB::transaction(function () use ($dados, $usuario) {
            $cliente = $this->resolverCliente($dados);
            $filialId = (int) (Filial::query()->value('id') ?: Filial::create([
                'nome' => 'Matriz',
                'codigo' => 'MAT',
                'ativa' => true,
            ])->id);
            $tabelaPrecoId = (int) (TabelaPreco::query()->where('codigo', 'VAREJO')->value('id')
                ?: TabelaPreco::create([
                    'nome' => 'Tabela Varejo',
                    'codigo' => 'VAREJO',
                    'tipo' => 'VAREJO',
                    'ativo' => true,
                    'prioridade' => 0,
                ])->id);
            $numeroExterno = trim((string) ($dados['numero_externo'] ?? ''));
            $numeroFiscal = $this->normalizarNumeroFiscal($numeroExterno ?: null);
            $this->validarNaoDuplicado($numeroFiscal, $numeroExterno !== '');

            $itens = [];
            foreach ($dados['itens'] as $item) {
                $produto = $this->resolverProduto($item, $tabelaPrecoId);
                $itens[] = [
                    'produto_id' => $produto->id,
                    'quantidade' => (float) $item['quantidade'],
                    'preco_unitario' => (float) $item['preco_unitario'],
                ];
            }

            $documento = $this->documentoService->create([
                'tipo' => 'VENDA',
                'status' => 'FATURADO',
                'cliente_id' => $cliente->id,
                'filial_id' => $filialId,
                'tabela_preco_id' => $tabelaPrecoId,
                'data_emissao' => $dados['data_emissao'],
                'desconto_total' => (float) ($dados['desconto'] ?? 0),
                'acrescimo_total' => 0,
                'impostos_total' => 0,
                'observacoes' => $this->buildObservacoes($dados),
                'itens' => $itens,
                'reservar_estoque' => false,
                'usar_preco_informado_itens' => true,
            ], $usuario);

            $this->ajustarTotaisImportados($documento, $dados);

            Faturamento::updateOrCreate(
                ['documento_id' => $documento->id],
                [
                    'numero_fiscal' => $numeroFiscal,
                    'chave_acesso' => $dados['chave_acesso'] ?? null,
                    'status_fiscal' => 'AUTORIZADO',
                    'data_faturamento' => $dados['data_emissao'],
                ]
            );

            ContaReceber::updateOrCreate(
                ['documento_id' => $documento->id],
                [
                    'cliente_id' => $cliente->id,
                    'valor_original' => (float) ($dados['total'] ?? $documento->total_liquido),
                    'valor_aberto' => 0,
                    'vencimento' => now()->toDateString(),
                    'status' => 'QUITADO',
                ]
            );

            if (!empty($dados['forma_pagamento'])) {
                DocumentoPagamento::create([
                    'documento_id' => $documento->id,
                    'forma_pagamento' => Str::limit((string) $dados['forma_pagamento'], 50, ''),
                    'valor' => (float) ($dados['total'] ?? $documento->total_liquido),
                    'parcelas' => 1,
                    'status' => 'AUTORIZADO',
                    'data_pagamento' => $dados['data_emissao'],
                    'metadata' => [
                        'origem' => 'PDF_LEGADO',
                    ],
                ]);
            }

            $documento->eventos()->create([
                'status_anterior' => 'FATURADO',
                'status_novo' => 'FATURADO',
                'acao' => 'IMPORTACAO_PDF_LEGADO',
                'usuario_id' => $usuario->id,
                'data_evento' => now(),
                'detalhes' => [
                    'numero_externo' => $dados['numero_externo'] ?? null,
                    'operador_legacy' => $dados['operador_nome'] ?? null,
                ],
            ]);

            return $documento->fresh(['cliente', 'itens', 'faturamento']);
        });
    }

    private function resolverCliente(array $dados): Cliente
    {
        $doc = preg_replace('/\D/', '', (string) ($dados['cliente_cpf_cnpj'] ?? ''));

        if ($doc !== '') {
            $clientePorDoc = Cliente::query()->whereRaw('REPLACE(REPLACE(REPLACE(cpf_cnpj, ".", ""), "-", ""), "/", "") = ?', [$doc])->first();
            if ($clientePorDoc) {
                return $clientePorDoc;
            }
        }

        $clientePorNome = Cliente::query()->where('nome', trim((string) $dados['cliente_nome']))->first();
        if ($clientePorNome) {
            return $clientePorNome;
        }

        return Cliente::create([
            'tipo_pessoa' => strlen($doc) === 14 ? 'PJ' : 'PF',
            'nome' => trim((string) $dados['cliente_nome']),
            'cpf_cnpj' => $doc !== '' ? $doc : (string) now()->format('YmdHisv'),
            'ativo' => true,
            'pais' => 'Brasil',
        ]);
    }

    private function resolverProduto(array $item, int $tabelaPrecoId): Produto
    {
        $ean = preg_replace('/\D/', '', (string) ($item['ean'] ?? ''));
        $nome = trim((string) $item['nome']);

        if ($ean !== '') {
            $porEan = Produto::query()->whereRaw('REPLACE(codigo_barras, " ", "") = ?', [$ean])->first();
            if ($porEan) {
                return $porEan;
            }
        }

        $porNome = Produto::query()->where('nome', $nome)->first();
        if ($porNome) {
            return $porNome;
        }

        $categoriaId = (int) (CategoriaProduto::where('ativo', true)->value('id') ?: CategoriaProduto::create(['nome' => 'Geral', 'ativo' => true])->id);
        $unidadeSigla = strtoupper((string) ($item['unidade'] ?? 'UN'));
        $unidadeId = (int) (UnidadeMedida::where('sigla', $unidadeSigla)->value('id') ?: UnidadeMedida::create([
            'sigla' => $unidadeSigla,
            'nome' => $unidadeSigla === 'UN' ? 'Unidade' : $unidadeSigla,
            'casas_decimais' => $unidadeSigla === 'UN' ? 0 : 3,
            'ativo' => true,
        ])->id);

        $produto = Produto::create([
            'sku' => 'LEG-' . Str::upper(Str::random(8)),
            'nome' => $nome,
            'descricao' => 'Importado de PDF legado',
            'codigo_barras' => $ean !== '' ? $ean : null,
            'categoria_id' => $categoriaId,
            'unidade_principal_id' => $unidadeId,
            'controla_lote' => false,
            'controla_validade' => false,
            'ativo' => true,
            'permite_venda' => true,
            'permite_compra' => true,
            'marca' => null,
        ]);

        EstoqueSaldo::firstOrCreate(
            ['produto_id' => $produto->id],
            ['quantidade_atual' => 0, 'quantidade_reservada' => 0, 'estoque_minimo' => 0, 'updated_at' => now()]
        );

        ProdutoPreco::create([
            'produto_id' => $produto->id,
            'tabela_preco_id' => $tabelaPrecoId,
            'preco' => (float) ($item['preco_unitario'] ?? 0),
            'custo_referencia' => 0,
            'margem_percentual' => null,
            'vigencia_inicio' => now(),
            'ativo' => true,
        ]);

        return $produto;
    }

    private function ajustarTotaisImportados(DocumentoComercial $documento, array $dados): void
    {
        $subtotal = (float) ($dados['subtotal'] ?? $documento->subtotal);
        $desconto = (float) ($dados['desconto'] ?? 0);
        $total = (float) ($dados['total'] ?? max(0, $subtotal - $desconto));

        $documento->update([
            'status' => 'FATURADO',
            'subtotal' => $subtotal,
            'desconto_total' => $desconto,
            'acrescimo_total' => 0,
            'impostos_total' => 0,
            'total_liquido' => $total,
        ]);
    }

    private function buildObservacoes(array $dados): string
    {
        $chunks = [
            'Importado de PDF legado.',
        ];

        if (!empty($dados['numero_externo'])) {
            $chunks[] = 'Numero externo: ' . $dados['numero_externo'];
        }

        if (!empty($dados['operador_nome'])) {
            $chunks[] = 'Operador legado: ' . $dados['operador_nome'];
        }

        return implode(' ', $chunks);
    }

    private function normalizarNumeroFiscal(?string $numeroExterno): string
    {
        $numeroExterno = trim((string) $numeroExterno);
        if ($numeroExterno === '') {
            return 'NF-LEG-' . now()->format('YmdHis') . '-' . random_int(100, 999);
        }

        return Str::limit('NF-LEG-' . preg_replace('/[^A-Za-z0-9\-]/', '', $numeroExterno), 60, '');
    }

    private function validarNaoDuplicado(string $numeroFiscal, bool $possuiNumeroExterno): void
    {
        if (!$possuiNumeroExterno) {
            return;
        }

        if (Faturamento::query()->where('numero_fiscal', $numeroFiscal)->exists()) {
            throw ValidationException::withMessages([
                'arquivos' => "Venda legado ja importada para numero fiscal {$numeroFiscal}.",
            ]);
        }
    }
}
