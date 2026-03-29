<?php

namespace App\Services\Comercial;

use App\Models\AuditoriaLog;
use App\Models\ContaReceber;
use App\Models\DocumentoComercial;
use App\Models\DocumentoEvento;
use App\Models\EstoqueMovimentacao;
use App\Models\EstoqueReserva;
use App\Models\EstoqueSaldo;
use App\Models\Faturamento;
use App\Models\Filial;
use App\Models\Produto;
use App\Models\ProdutoPreco;
use App\Models\TabelaPreco;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DocumentoComercialService
{
    public const STATUS_POR_TIPO = [
        'ORCAMENTO' => ['RASCUNHO', 'PENDENTE', 'CONCLUIDO', 'CANCELADO'],
        'PREVENDA' => ['RASCUNHO', 'AGUARDANDO_PAGAMENTO', 'CONCLUIDO', 'CANCELADO'],
        'PEDIDO' => ['EM_SEPARACAO', 'AGUARDANDO_PAGAMENTO', 'AGUARDANDO_FATURAMENTO', 'CONCLUIDO', 'FATURADO', 'CANCELADO'],
        'VENDA' => ['AGUARDANDO_PAGAMENTO', 'AGUARDANDO_FATURAMENTO', 'FATURADO', 'CANCELADO'],
    ];

    private const TRANSICOES_STATUS = [
        'RASCUNHO' => ['PENDENTE', 'AGUARDANDO_PAGAMENTO', 'CANCELADO'],
        'PENDENTE' => ['CONCLUIDO', 'CANCELADO', 'EM_SEPARACAO', 'AGUARDANDO_PAGAMENTO'],
        'AGUARDANDO_PAGAMENTO' => ['EM_SEPARACAO', 'AGUARDANDO_FATURAMENTO', 'CONCLUIDO', 'CANCELADO'],
        'EM_SEPARACAO' => ['AGUARDANDO_FATURAMENTO', 'CONCLUIDO', 'CANCELADO'],
        'AGUARDANDO_FATURAMENTO' => ['FATURADO', 'CANCELADO'],
        'CONCLUIDO' => ['FATURADO', 'CANCELADO'],
        'FATURADO' => [],
        'CANCELADO' => [],
    ];

    public function create(array $data, User $usuario): DocumentoComercial
    {
        return DB::transaction(function () use ($data, $usuario) {
            $status = $data['status'] ?? $this->statusInicial($data['tipo']);
            $this->validarStatusPorTipo($data['tipo'], $status);

            $documento = DocumentoComercial::create([
                'numero' => $this->gerarNumero($data['tipo']),
                'tipo' => $data['tipo'],
                'status' => $status,
                'documento_origem_id' => $data['documento_origem_id'] ?? null,
                'cliente_id' => $data['cliente_id'],
                'vendedor_id' => $usuario->id,
                'operador_id' => $usuario->id,
                'filial_id' => $data['filial_id'] ?? Filial::query()->value('id'),
                'tabela_preco_id' => $data['tabela_preco_id'] ?? TabelaPreco::query()->where('codigo', 'VAREJO')->value('id'),
                'data_emissao' => $data['data_emissao'] ?? now(),
                'validade_orcamento' => $data['validade_orcamento'] ?? null,
                'subtotal' => 0,
                'desconto_total' => (float) ($data['desconto_total'] ?? 0),
                'acrescimo_total' => (float) ($data['acrescimo_total'] ?? 0),
                'impostos_total' => (float) ($data['impostos_total'] ?? 0),
                'total_liquido' => 0,
                'observacoes' => $data['observacoes'] ?? null,
            ]);

            $this->syncItens(
                $documento,
                $data['itens'] ?? [],
                true,
                (bool) ($data['usar_preco_informado_itens'] ?? false)
            );
            $this->recalcularTotais($documento);
            $this->logEvento($documento, null, $documento->status, 'CRIADO', $usuario->id, [
                'tipo' => $documento->tipo,
            ]);

            $reservarEstoque = (bool) ($data['reservar_estoque'] ?? true);
            if ($reservarEstoque && in_array($documento->tipo, ['PEDIDO', 'VENDA'], true)) {
                $this->reservarEstoque($documento, $usuario->id);
            }

            $this->registrarAuditoria(
                'DOCUMENTO_CRIADO',
                $documento,
                $usuario->id,
                null,
                $this->snapshotDocumento($documento)
            );

            return $documento->fresh(['itens.produto', 'cliente', 'vendedor', 'eventos']);
        });
    }

    public function update(DocumentoComercial $documento, array $data, User $usuario): DocumentoComercial
    {
        $regrasEdicao = $this->regrasEdicao($documento);
        if (!$regrasEdicao['pode_editar']) {
            throw ValidationException::withMessages([
                'status' => $regrasEdicao['motivo'] ?? 'Documento nao pode ser alterado nesta etapa.',
            ]);
        }

        if (!$regrasEdicao['permite_alterar_itens'] && $this->itensForamAlterados($documento, $data['itens'] ?? [])) {
            throw ValidationException::withMessages([
                'itens' => 'Nesta etapa nao e permitido alterar itens do documento.',
            ]);
        }

        return DB::transaction(function () use ($documento, $data, $usuario) {
            $statusAnterior = $documento->status;
            $statusNovo = (string) ($data['status'] ?? $documento->status);
            $antes = $this->snapshotDocumento($documento);
            $this->validarStatusPorTipo($documento->tipo, $statusNovo);
            $this->validarTransicaoStatus($documento->tipo, $statusAnterior, $statusNovo);

            $documento->update([
                'cliente_id' => $data['cliente_id'],
                'filial_id' => $data['filial_id'] ?? $documento->filial_id,
                'tabela_preco_id' => $data['tabela_preco_id'] ?? $documento->tabela_preco_id,
                'data_emissao' => $data['data_emissao'] ?? $documento->data_emissao,
                'validade_orcamento' => $data['validade_orcamento'] ?? null,
                'desconto_total' => (float) ($data['desconto_total'] ?? 0),
                'acrescimo_total' => (float) ($data['acrescimo_total'] ?? 0),
                'impostos_total' => (float) ($data['impostos_total'] ?? 0),
                'observacoes' => $data['observacoes'] ?? null,
                'status' => $statusNovo,
            ]);

            $this->cancelarReservasAtivas($documento);
            $this->syncItens(
                $documento,
                $data['itens'] ?? [],
                false,
                (bool) ($data['usar_preco_informado_itens'] ?? false)
            );
            $this->recalcularTotais($documento);

            $usaReservaDaOrigem = $documento->tipo === 'VENDA' && $documento->documento_origem_id && $documento->origem?->tipo === 'PEDIDO';
            if (!$usaReservaDaOrigem && in_array($documento->tipo, ['PEDIDO', 'VENDA'], true) && $documento->status !== 'CANCELADO') {
                $this->reservarEstoque($documento, $usuario->id);
            }

            if ($statusAnterior !== $documento->status) {
                $this->logEvento($documento, $statusAnterior, $documento->status, 'STATUS_ATUALIZADO', $usuario->id);
            }

            $this->registrarAuditoria(
                'DOCUMENTO_ATUALIZADO',
                $documento,
                $usuario->id,
                $antes,
                $this->snapshotDocumento($documento)
            );

            return $documento->fresh(['itens.produto', 'cliente', 'vendedor', 'eventos']);
        });
    }

    public function converterOrcamentoParaPedido(DocumentoComercial $orcamento, User $usuario): DocumentoComercial
    {
        if ($orcamento->tipo !== 'ORCAMENTO' || $orcamento->status !== 'PENDENTE') {
            throw ValidationException::withMessages([
                'tipo' => "Conversao bloqueada: documento {$orcamento->numero} esta em {$orcamento->tipo}/{$orcamento->status}. Esperado ORCAMENTO/PENDENTE.",
            ]);
        }

        $pedido = $this->create([
            'tipo' => 'PEDIDO',
            'status' => 'EM_SEPARACAO',
            'documento_origem_id' => $orcamento->id,
            'cliente_id' => $orcamento->cliente_id,
            'filial_id' => $orcamento->filial_id,
            'tabela_preco_id' => $orcamento->tabela_preco_id,
            'desconto_total' => $orcamento->desconto_total,
            'acrescimo_total' => $orcamento->acrescimo_total,
            'impostos_total' => $orcamento->impostos_total,
            'observacoes' => $orcamento->observacoes,
            'itens' => $orcamento->itens->map(fn ($item) => [
                'produto_id' => $item->produto_id,
                'quantidade' => $item->quantidade,
                'preco_unitario' => $item->preco_unitario,
            ])->all(),
        ], $usuario);

        $orcamento->update(['status' => 'CONCLUIDO']);
        $this->logEvento($orcamento, 'PENDENTE', 'CONCLUIDO', 'CONVERTIDO_PEDIDO', $usuario->id, [
            'pedido_id' => $pedido->id,
            'pedido_numero' => $pedido->numero,
        ]);
        $this->registrarAuditoria(
            'ORCAMENTO_CONVERTIDO_PEDIDO',
            $orcamento,
            $usuario->id,
            ['status' => 'PENDENTE'],
            ['status' => 'CONCLUIDO', 'pedido_id' => $pedido->id, 'pedido_numero' => $pedido->numero]
        );

        return $pedido;
    }

    public function converterPedidoParaVenda(DocumentoComercial $pedido, User $usuario): DocumentoComercial
    {
        if ($pedido->tipo !== 'PEDIDO' || !in_array($pedido->status, ['EM_SEPARACAO', 'AGUARDANDO_PAGAMENTO'], true)) {
            throw ValidationException::withMessages([
                'tipo' => "Conversao bloqueada: documento {$pedido->numero} esta em {$pedido->tipo}/{$pedido->status}. Esperado PEDIDO/EM_SEPARACAO ou PEDIDO/AGUARDANDO_PAGAMENTO.",
            ]);
        }

        $venda = $this->create([
            'tipo' => 'VENDA',
            'status' => 'AGUARDANDO_FATURAMENTO',
            'documento_origem_id' => $pedido->id,
            'cliente_id' => $pedido->cliente_id,
            'filial_id' => $pedido->filial_id,
            'tabela_preco_id' => $pedido->tabela_preco_id,
            'desconto_total' => $pedido->desconto_total,
            'acrescimo_total' => $pedido->acrescimo_total,
            'impostos_total' => $pedido->impostos_total,
            'observacoes' => $pedido->observacoes,
            'itens' => $pedido->itens->map(fn ($item) => [
                'produto_id' => $item->produto_id,
                'quantidade' => $item->quantidade,
                'preco_unitario' => $item->preco_unitario,
            ])->all(),
            'reservar_estoque' => false,
        ], $usuario);

        $statusAnterior = $pedido->status;
        $pedido->update(['status' => 'AGUARDANDO_FATURAMENTO']);
        $this->logEvento($pedido, $statusAnterior, 'AGUARDANDO_FATURAMENTO', 'CONVERTIDO_VENDA', $usuario->id, [
            'venda_id' => $venda->id,
            'venda_numero' => $venda->numero,
        ]);
        $this->registrarAuditoria(
            'PEDIDO_CONVERTIDO_VENDA',
            $pedido,
            $usuario->id,
            ['status' => $statusAnterior],
            ['status' => 'AGUARDANDO_FATURAMENTO', 'venda_id' => $venda->id, 'venda_numero' => $venda->numero]
        );

        return $venda;
    }

    public function faturar(DocumentoComercial $documento, User $usuario): DocumentoComercial
    {
        if (!in_array($documento->tipo, ['PEDIDO', 'VENDA'], true)) {
            throw ValidationException::withMessages([
                'tipo' => "Faturamento bloqueado: {$documento->tipo} nao pode ser faturado.",
            ]);
        }

        if ($documento->status === 'FATURADO') {
            return $documento;
        }

        return DB::transaction(function () use ($documento, $usuario) {
            $antes = $this->snapshotDocumento($documento);
            $referenciaReserva = $documento;
            if ($documento->tipo === 'VENDA' && $documento->origem?->tipo === 'PEDIDO') {
                $referenciaReserva = $documento->origem;
            }

            $referenciaReserva->loadMissing('itens.reserva');
            foreach ($referenciaReserva->itens as $item) {
                $reserva = $item->reserva;
                if (!$reserva || $reserva->status !== 'ATIVA') {
                    throw ValidationException::withMessages([
                        'estoque' => "Item {$item->descricao} sem reserva ativa para faturamento.",
                    ]);
                }

                $saldo = EstoqueSaldo::lockForUpdate()->firstOrCreate(
                    ['produto_id' => $item->produto_id],
                    ['quantidade_atual' => 0, 'quantidade_reservada' => 0, 'estoque_minimo' => 0, 'updated_at' => now()]
                );

                $quantidade = (float) $reserva->quantidade_reservada;
                if ((float) $saldo->quantidade_atual < $quantidade) {
                    throw ValidationException::withMessages([
                        'estoque' => "Estoque atual insuficiente para faturar {$item->descricao}.",
                    ]);
                }

                $novoSaldoAtual = (float) $saldo->quantidade_atual - $quantidade;
                $novoReservado = max(0, (float) $saldo->quantidade_reservada - $quantidade);

                $saldo->update([
                    'quantidade_atual' => $novoSaldoAtual,
                    'quantidade_reservada' => $novoReservado,
                    'updated_at' => now(),
                ]);

                $reserva->update([
                    'status' => 'CONSUMIDA',
                    'data_consumo' => now(),
                ]);

                EstoqueMovimentacao::create([
                    'produto_id' => $item->produto_id,
                    'estoque_lote_id' => null,
                    'estoque_reserva_id' => $reserva->id,
                    'tipo' => 'SAIDA',
                    'origem' => 'FATURAMENTO',
                    'origem_tipo' => 'DOCUMENTO_COMERCIAL',
                    'origem_id' => $documento->id,
                    'documento_ref' => $documento->numero,
                    'quantidade' => $quantidade,
                    'sinal' => -1,
                    'saldo_apos' => $novoSaldoAtual,
                    'observacao' => "Faturamento do documento {$documento->numero}",
                    'user_id' => $usuario->id,
                    'created_at' => now(),
                ]);
            }

            $statusAnterior = $documento->status;
            $documento->update(['status' => 'FATURADO']);
            if ($documento->origem && $documento->origem->tipo === 'PEDIDO') {
                $documento->origem->update(['status' => 'FATURADO']);
            }

            Faturamento::updateOrCreate(
                ['documento_id' => $documento->id],
                [
                    'numero_fiscal' => $this->gerarNumeroFiscal(),
                    'status_fiscal' => 'AUTORIZADO',
                    'data_faturamento' => now(),
                ]
            );

            ContaReceber::updateOrCreate(
                ['documento_id' => $documento->id],
                [
                    'cliente_id' => $documento->cliente_id,
                    'valor_original' => $documento->total_liquido,
                    'valor_aberto' => $documento->total_liquido,
                    'vencimento' => now()->toDateString(),
                    'status' => ((float) $documento->total_liquido) > 0 ? 'ABERTO' : 'QUITADO',
                ]
            );

            $this->logEvento($documento, $statusAnterior, 'FATURADO', 'FATURADO', $usuario->id);
            $this->registrarAuditoria(
                'DOCUMENTO_FATURADO',
                $documento,
                $usuario->id,
                $antes,
                $this->snapshotDocumento($documento)
            );

            return $documento->fresh(['faturamento', 'itens.produto', 'cliente']);
        });
    }

    public function acoesFluxoDisponiveis(DocumentoComercial $documento): array
    {
        return [
            'converter_pedido' => [
                'permitido' => $documento->tipo === 'ORCAMENTO' && $documento->status === 'PENDENTE',
                'motivo' => 'Disponivel apenas para ORCAMENTO em PENDENTE.',
            ],
            'converter_venda' => [
                'permitido' => $documento->tipo === 'PEDIDO' && in_array($documento->status, ['EM_SEPARACAO', 'AGUARDANDO_PAGAMENTO'], true),
                'motivo' => 'Disponivel apenas para PEDIDO em EM_SEPARACAO ou AGUARDANDO_PAGAMENTO.',
            ],
            'faturar' => [
                'permitido' => in_array($documento->tipo, ['PEDIDO', 'VENDA'], true)
                    && in_array($documento->status, ['AGUARDANDO_FATURAMENTO', 'CONCLUIDO', 'AGUARDANDO_PAGAMENTO', 'EM_SEPARACAO'], true),
                'motivo' => 'Disponivel apenas para PEDIDO/VENDA em etapa de fechamento.',
            ],
        ];
    }

    public function cancelar(DocumentoComercial $documento, User $usuario, string $motivoCancelamento): void
    {
        if ($documento->status === 'FATURADO') {
            throw ValidationException::withMessages([
                'status' => 'Documento faturado nao pode ser cancelado por esta rotina.',
            ]);
        }

        if ($documento->derivados()->whereNotIn('status', ['CANCELADO'])->exists()) {
            throw ValidationException::withMessages([
                'status' => 'Documento possui derivados ativos e nao pode ser cancelado.',
            ]);
        }

        DB::transaction(function () use ($documento, $usuario, $motivoCancelamento) {
            $antes = $this->snapshotDocumento($documento);
            $statusAnterior = $documento->status;
            $this->cancelarReservasAtivas($documento);
            $documento->update(['status' => 'CANCELADO']);
            $this->logEvento($documento, $statusAnterior, 'CANCELADO', 'CANCELADO', $usuario->id, [
                'motivo_cancelamento' => $motivoCancelamento,
                'total_itens' => $documento->itens()->count(),
                'total_liquido' => (float) $documento->total_liquido,
            ]);
            $this->registrarAuditoria(
                'DOCUMENTO_CANCELADO',
                $documento,
                $usuario->id,
                $antes,
                array_merge($this->snapshotDocumento($documento), ['motivo_cancelamento' => $motivoCancelamento])
            );
        });
    }

    public function reabrir(DocumentoComercial $documento, User $usuario, string $motivoReabertura): DocumentoComercial
    {
        if ($documento->status !== 'CANCELADO') {
            throw ValidationException::withMessages([
                'status' => 'Somente documento cancelado pode ser reaberto.',
            ]);
        }

        return DB::transaction(function () use ($documento, $usuario, $motivoReabertura) {
            if ($documento->trashed()) {
                $documento->restore();
            }
            $antes = ['status' => 'CANCELADO'];

            $statusReaberto = $this->statusInicial($documento->tipo);

            $documento->update([
                'status' => $statusReaberto,
            ]);

            $this->logEvento($documento, 'CANCELADO', $statusReaberto, 'REABERTO', $usuario->id, [
                'motivo_reabertura' => $motivoReabertura,
            ]);
            $this->registrarAuditoria(
                'DOCUMENTO_REABERTO',
                $documento,
                $usuario->id,
                $antes,
                array_merge($this->snapshotDocumento($documento), ['motivo_reabertura' => $motivoReabertura])
            );

            return $documento->fresh(['itens', 'eventos', 'cliente']);
        });
    }

    public function regrasEdicao(DocumentoComercial $documento): array
    {
        if (in_array($documento->status, ['FATURADO', 'CANCELADO'], true)) {
            return [
                'pode_editar' => false,
                'permite_alterar_itens' => false,
                'permite_alterar_cabecalho' => false,
                'motivo' => 'Documento finalizado.',
            ];
        }

        return match ($documento->tipo) {
            'ORCAMENTO' => [
                'pode_editar' => in_array($documento->status, ['RASCUNHO', 'PENDENTE'], true),
                'permite_alterar_itens' => true,
                'permite_alterar_cabecalho' => true,
                'motivo' => 'Orcamentos concluidos nao podem ser alterados.',
            ],
            'PREVENDA' => [
                'pode_editar' => in_array($documento->status, ['RASCUNHO', 'AGUARDANDO_PAGAMENTO'], true),
                'permite_alterar_itens' => true,
                'permite_alterar_cabecalho' => true,
                'motivo' => 'Prevenda concluida nao pode ser alterada.',
            ],
            'PEDIDO' => [
                'pode_editar' => in_array($documento->status, ['EM_SEPARACAO', 'AGUARDANDO_PAGAMENTO'], true),
                'permite_alterar_itens' => $documento->status === 'EM_SEPARACAO',
                'permite_alterar_cabecalho' => true,
                'motivo' => 'Pedido nesta etapa nao permite edicao.',
            ],
            'VENDA' => [
                'pode_editar' => in_array($documento->status, ['AGUARDANDO_PAGAMENTO', 'AGUARDANDO_FATURAMENTO'], true),
                'permite_alterar_itens' => false,
                'permite_alterar_cabecalho' => true,
                'motivo' => 'Venda nesta etapa nao permite edicao de itens.',
            ],
            default => [
                'pode_editar' => false,
                'permite_alterar_itens' => false,
                'permite_alterar_cabecalho' => false,
                'motivo' => 'Tipo de documento sem regra de edicao.',
            ],
        };
    }

    private function syncItens(DocumentoComercial $documento, array $itens, bool $novo, bool $usarPrecoInformadoItens = false): void
    {
        if (!$novo) {
            $documento->itens()->delete();
        }

        $documento->loadMissing('tabelaPreco');

        foreach ($itens as $index => $item) {
            $produto = Produto::findOrFail((int) $item['produto_id']);
            $quantidade = (float) $item['quantidade'];

            $precoTabela = $this->precoTabela($produto->id, $documento->tabela_preco_id);
            $precoUnitario = $precoTabela;

            if (($documento->tipo === 'ORCAMENTO' || $usarPrecoInformadoItens) && isset($item['preco_unitario'])) {
                $precoUnitario = (float) $item['preco_unitario'];
            }

            $subtotalBruto = round($precoUnitario * $quantidade, 2);

            $documento->itens()->create([
                'sequencia' => $index + 1,
                'produto_id' => $produto->id,
                'descricao' => $produto->nome,
                'unidade_sigla' => $produto->unidadePrincipal?->sigla ?? 'UN',
                'quantidade' => $quantidade,
                'preco_tabela' => $precoTabela,
                'preco_unitario' => $precoUnitario,
                'subtotal_bruto' => $subtotalBruto,
                'subtotal_liquido' => $subtotalBruto,
                'metadata' => [
                    'produto_sku' => $produto->sku,
                    'preco_editavel' => $documento->tipo === 'ORCAMENTO',
                ],
            ]);
        }
    }

    private function reservarEstoque(DocumentoComercial $documento, int $userId): void
    {
        $documento->loadMissing('itens');

        foreach ($documento->itens as $item) {
            $saldo = EstoqueSaldo::lockForUpdate()->firstOrCreate(
                ['produto_id' => $item->produto_id],
                ['quantidade_atual' => 0, 'quantidade_reservada' => 0, 'estoque_minimo' => 0, 'updated_at' => now()]
            );

            $quantidade = (float) $item->quantidade;
            $disponivel = (float) $saldo->quantidade_atual - (float) $saldo->quantidade_reservada;

            if ($disponivel < $quantidade) {
                throw ValidationException::withMessages([
                    'estoque' => "Estoque insuficiente para {$item->descricao}. Disponivel: {$disponivel}.",
                ]);
            }

            $saldo->update([
                'quantidade_reservada' => (float) $saldo->quantidade_reservada + $quantidade,
                'updated_at' => now(),
            ]);

            EstoqueReserva::updateOrCreate(
                ['documento_item_id' => $item->id],
                [
                    'produto_id' => $item->produto_id,
                    'quantidade_reservada' => $quantidade,
                    'status' => 'ATIVA',
                    'data_reserva' => now(),
                    'data_consumo' => null,
                ]
            );

            $this->logEvento($documento, $documento->status, $documento->status, 'RESERVA_ESTOQUE', $userId, [
                'item_id' => $item->id,
                'produto_id' => $item->produto_id,
                'quantidade' => $quantidade,
            ]);
        }
    }

    private function cancelarReservasAtivas(DocumentoComercial $documento): void
    {
        $documento->loadMissing('itens.reserva');

        foreach ($documento->itens as $item) {
            $reserva = $item->reserva;
            if (!$reserva || $reserva->status !== 'ATIVA') {
                continue;
            }

            $saldo = EstoqueSaldo::lockForUpdate()->firstOrCreate(
                ['produto_id' => $item->produto_id],
                ['quantidade_atual' => 0, 'quantidade_reservada' => 0, 'estoque_minimo' => 0, 'updated_at' => now()]
            );

            $saldo->update([
                'quantidade_reservada' => max(0, (float) $saldo->quantidade_reservada - (float) $reserva->quantidade_reservada),
                'updated_at' => now(),
            ]);

            $reserva->update([
                'status' => 'CANCELADA',
                'data_consumo' => now(),
            ]);
        }
    }

    private function recalcularTotais(DocumentoComercial $documento): void
    {
        $subtotal = (float) $documento->itens()->sum('subtotal_bruto');
        $totalLiquido = $subtotal
            - (float) $documento->desconto_total
            + (float) $documento->acrescimo_total
            + (float) $documento->impostos_total;

        $documento->update([
            'subtotal' => $subtotal,
            'total_liquido' => max(0, round($totalLiquido, 2)),
        ]);
    }

    private function statusInicial(string $tipo): string
    {
        return match ($tipo) {
            'ORCAMENTO' => 'PENDENTE',
            'PREVENDA' => 'AGUARDANDO_PAGAMENTO',
            'PEDIDO' => 'EM_SEPARACAO',
            'VENDA' => 'AGUARDANDO_FATURAMENTO',
            default => 'RASCUNHO',
        };
    }

    private function validarStatusPorTipo(string $tipo, string $status): void
    {
        $permitidos = self::STATUS_POR_TIPO[$tipo] ?? [];
        if (!in_array($status, $permitidos, true)) {
            throw ValidationException::withMessages([
                'status' => "Status {$status} nao permitido para o tipo {$tipo}.",
            ]);
        }
    }

    private function validarTransicaoStatus(string $tipo, string $statusAnterior, string $statusNovo): void
    {
        if ($statusAnterior === $statusNovo) {
            return;
        }

        $permitidas = self::TRANSICOES_STATUS[$statusAnterior] ?? [];
        if (!in_array($statusNovo, $permitidas, true)) {
            throw ValidationException::withMessages([
                'status' => "Transicao de status invalida para {$tipo}: {$statusAnterior} -> {$statusNovo}.",
            ]);
        }
    }

    private function precoTabela(int $produtoId, ?int $tabelaPrecoId): float
    {
        $query = ProdutoPreco::query()
            ->where('produto_id', $produtoId)
            ->where('ativo', true)
            ->where(function ($q) {
                $q->whereNull('vigencia_fim')->orWhere('vigencia_fim', '>=', now());
            })
            ->orderByDesc('vigencia_inicio');

        if ($tabelaPrecoId) {
            $registro = (clone $query)->where('tabela_preco_id', $tabelaPrecoId)->first();
            if ($registro) {
                return (float) $registro->preco;
            }
        }

        return (float) ($query->first()?->preco ?? 0);
    }

    private function gerarNumero(string $tipo): string
    {
        $prefixo = match ($tipo) {
            'ORCAMENTO' => 'ORC',
            'PREVENDA' => 'PVD',
            'PEDIDO' => 'PED',
            'VENDA' => 'VND',
            default => 'DOC',
        };

        $ultimo = DocumentoComercial::query()->where('tipo', $tipo)->max('id') ?? 0;

        return sprintf('%s-%s-%06d', $prefixo, now()->format('Ymd'), $ultimo + 1);
    }

    private function gerarNumeroFiscal(): string
    {
        return 'NF-' . now()->format('YmdHis') . '-' . random_int(100, 999);
    }

    private function logEvento(DocumentoComercial $documento, ?string $statusAnterior, string $statusNovo, string $acao, ?int $usuarioId, array $detalhes = []): void
    {
        DocumentoEvento::create([
            'documento_id' => $documento->id,
            'status_anterior' => $statusAnterior,
            'status_novo' => $statusNovo,
            'acao' => $acao,
            'usuario_id' => $usuarioId,
            'data_evento' => now(),
            'detalhes' => $detalhes,
        ]);
    }

    private function itensForamAlterados(DocumentoComercial $documento, array $itensPayload): bool
    {
        $atuais = $documento->itens()
            ->orderBy('sequencia')
            ->get(['produto_id', 'quantidade', 'preco_unitario'])
            ->map(fn ($item) => [
                'produto_id' => (int) $item->produto_id,
                'quantidade' => round((float) $item->quantidade, 3),
                'preco_unitario' => round((float) $item->preco_unitario, 4),
            ])
            ->values()
            ->all();

        $novos = collect($itensPayload)
            ->map(fn ($item) => [
                'produto_id' => (int) ($item['produto_id'] ?? 0),
                'quantidade' => round((float) ($item['quantidade'] ?? 0), 3),
                'preco_unitario' => round((float) ($item['preco_unitario'] ?? 0), 4),
            ])
            ->values()
            ->all();

        return $atuais !== $novos;
    }

    private function snapshotDocumento(DocumentoComercial $documento): array
    {
        return [
            'id' => $documento->id,
            'numero' => $documento->numero,
            'tipo' => $documento->tipo,
            'status' => $documento->status,
            'cliente_id' => $documento->cliente_id,
            'filial_id' => $documento->filial_id,
            'total_liquido' => (float) $documento->total_liquido,
            'subtotal' => (float) $documento->subtotal,
        ];
    }

    private function registrarAuditoria(
        string $acao,
        DocumentoComercial $documento,
        ?int $usuarioId,
        ?array $dadosAntes,
        ?array $dadosDepois
    ): void {
        AuditoriaLog::create([
            'usuario_id' => $usuarioId,
            'acao' => $acao,
            'entidade_tipo' => 'DOCUMENTO_COMERCIAL',
            'entidade_id' => $documento->id,
            'dados_antes' => $dadosAntes,
            'dados_depois' => $dadosDepois,
        ]);
    }
}
