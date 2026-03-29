<?php

namespace App\Services\Compras;

use App\Models\AuditoriaLog;
use App\Models\Compra;
use App\Models\ContaPagar;
use App\Models\EstoqueLote;
use App\Models\EstoqueMovimentacao;
use App\Models\EstoqueSaldo;
use App\Models\Filial;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CompraService
{
    public function create(array $data, User $usuario): Compra
    {
        return DB::transaction(function () use ($data, $usuario) {
            $compra = Compra::create([
                'numero' => $this->gerarNumero(),
                'fornecedor_id' => $data['fornecedor_id'],
                'usuario_id' => $usuario->id,
                'filial_id' => $data['filial_id'] ?? Filial::query()->value('id'),
                'data_compra' => $data['data_compra'] ?? now(),
                'status' => $data['status'] ?? 'CONFIRMADA',
                'valor_total' => 0,
                'observacoes' => $data['observacoes'] ?? null,
            ]);

            $total = 0;

            foreach ($data['itens'] as $index => $item) {
                $produto = Produto::findOrFail((int) $item['produto_id']);
                $quantidade = (float) $item['quantidade'];
                $precoUnitario = (float) $item['preco_unitario'];
                $subtotal = round($quantidade * $precoUnitario, 2);
                $total += $subtotal;

                $compraItem = $compra->itens()->create([
                    'sequencia' => $index + 1,
                    'produto_id' => $produto->id,
                    'quantidade' => $quantidade,
                    'preco_unitario' => $precoUnitario,
                    'subtotal' => $subtotal,
                    'numero_lote' => $item['numero_lote'] ?? null,
                    'data_validade' => $item['data_validade'] ?? null,
                ]);

                if ($compra->status === 'CONFIRMADA') {
                    $this->entradaEstoque($compra, $compraItem->produto_id, $quantidade, $usuario->id, $item['numero_lote'] ?? null, $item['data_validade'] ?? null);
                }
            }

            $compra->update(['valor_total' => round($total, 2)]);

            ContaPagar::create([
                'compra_id' => $compra->id,
                'fornecedor_id' => $compra->fornecedor_id,
                'valor_original' => round($total, 2),
                'valor_aberto' => round($total, 2),
                'vencimento' => $data['vencimento'] ?? now()->addDays(30)->toDateString(),
                'status' => round($total, 2) > 0 ? 'ABERTO' : 'QUITADO',
            ]);

            AuditoriaLog::create([
                'usuario_id' => $usuario->id,
                'acao' => 'COMPRA_CRIADA',
                'entidade_tipo' => 'COMPRA',
                'entidade_id' => $compra->id,
                'dados_antes' => null,
                'dados_depois' => [
                    'numero' => $compra->numero,
                    'fornecedor_id' => $compra->fornecedor_id,
                    'valor_total' => (float) $compra->valor_total,
                    'status' => $compra->status,
                ],
            ]);

            return $compra->fresh(['fornecedor', 'itens.produto', 'contaPagar']);
        });
    }

    private function entradaEstoque(Compra $compra, int $produtoId, float $quantidade, int $userId, ?string $numeroLote, ?string $dataValidade): void
    {
        $saldo = EstoqueSaldo::lockForUpdate()->firstOrCreate(
            ['produto_id' => $produtoId],
            ['quantidade_atual' => 0, 'quantidade_reservada' => 0, 'estoque_minimo' => 0, 'updated_at' => now()]
        );

        $novoSaldo = round((float) $saldo->quantidade_atual + $quantidade, 3);
        $saldo->update([
            'quantidade_atual' => $novoSaldo,
            'updated_at' => now(),
        ]);

        $loteId = null;
        if ($numeroLote || $dataValidade) {
            $lote = EstoqueLote::create([
                'produto_id' => $produtoId,
                'lote' => $numeroLote ?: 'SEM-LOTE',
                'serial' => null,
                'validade' => $dataValidade,
                'quantidade_disponivel' => $quantidade,
                'custo_unitario' => null,
            ]);
            $loteId = $lote->id;
        }

        EstoqueMovimentacao::create([
            'produto_id' => $produtoId,
            'estoque_lote_id' => $loteId,
            'estoque_reserva_id' => null,
            'tipo' => 'ENTRADA',
            'origem' => 'COMPRA',
            'origem_tipo' => 'COMPRA',
            'origem_id' => $compra->id,
            'documento_ref' => $compra->numero,
            'quantidade' => $quantidade,
            'sinal' => 1,
            'saldo_apos' => $novoSaldo,
            'observacao' => "Entrada por compra {$compra->numero}",
            'user_id' => $userId,
            'created_at' => now(),
        ]);
    }

    private function gerarNumero(): string
    {
        $ultimo = Compra::query()->max('id') ?? 0;
        return sprintf('CMP-%s-%06d', now()->format('Ymd'), $ultimo + 1);
    }
}
