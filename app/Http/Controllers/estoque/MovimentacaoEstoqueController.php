<?php

namespace App\Http\Controllers\estoque;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovimentacaoEstoqueRequest;
use App\Models\EstoqueLote;
use App\Models\EstoqueMovimentacao;
use App\Models\EstoqueSaldo;
use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MovimentacaoEstoqueController extends Controller
{
    public function index(Request $request): View
    {
        $query = EstoqueMovimentacao::query()
            ->with(['produto', 'lote'])
            ->orderByDesc('id');

        if ($request->filled('produto_id')) {
            $query->where('produto_id', (int) $request->integer('produto_id'));
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', (string) $request->string('tipo'));
        }

        $movimentacoes = $query->paginate(20)->withQueryString();

        return view('content.estoque.movimentacoes.index', [
            'movimentacoes' => $movimentacoes,
            'produtos' => Produto::orderBy('nome')->get(['id', 'nome', 'sku']),
            'filtros' => $request->only(['produto_id', 'tipo']),
        ]);
    }

    public function create(): View
    {
        return view('content.estoque.movimentacoes.create', [
            'produtos' => Produto::with('estoqueSaldo')->orderBy('nome')->get(),
            'tipos' => ['ENTRADA', 'SAIDA', 'AJUSTE'],
        ]);
    }

    public function store(StoreMovimentacaoEstoqueRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $request) {
            $produto = Produto::lockForUpdate()->findOrFail((int) $data['produto_id']);
            $saldo = EstoqueSaldo::lockForUpdate()->firstOrCreate(
                ['produto_id' => $produto->id],
                ['quantidade_atual' => 0, 'estoque_minimo' => 0, 'updated_at' => now()]
            );

            $tipoReal = $data['tipo'] === 'AJUSTE' ? $data['ajuste_direcao'] : $data['tipo'];
            $quantidade = (float) $data['quantidade'];
            $sinal = $tipoReal === 'SAIDA' ? -1 : 1;

            if ($produto->controla_lote && empty($data['lote'])) {
                throw ValidationException::withMessages(['lote' => 'Este produto exige lote para movimentacao.']);
            }

            $lote = null;
            if (!empty($data['lote'])) {
                $lote = EstoqueLote::lockForUpdate()->firstOrCreate(
                    [
                        'produto_id' => $produto->id,
                        'lote' => $data['lote'],
                        'serial' => $data['serial'] ?? null,
                    ],
                    [
                        'validade' => $data['validade'] ?? null,
                        'quantidade_disponivel' => 0,
                        'custo_unitario' => $data['custo_unitario'] ?? null,
                    ]
                );
            }

            if ($sinal < 0) {
                if ((float) $saldo->quantidade_atual < $quantidade) {
                    throw ValidationException::withMessages(['quantidade' => 'Saldo insuficiente para esta saida/ajuste.']);
                }

                if ($lote && (float) $lote->quantidade_disponivel < $quantidade) {
                    throw ValidationException::withMessages(['quantidade' => 'Saldo insuficiente no lote informado.']);
                }
            }

            $novoSaldo = (float) $saldo->quantidade_atual + ($quantidade * $sinal);
            $saldo->update([
                'quantidade_atual' => $novoSaldo,
                'updated_at' => now(),
            ]);

            if ($lote) {
                $lote->update([
                    'quantidade_disponivel' => (float) $lote->quantidade_disponivel + ($quantidade * $sinal),
                    'validade' => $data['validade'] ?? $lote->validade,
                    'custo_unitario' => $data['custo_unitario'] ?? $lote->custo_unitario,
                ]);
            }

            EstoqueMovimentacao::create([
                'produto_id' => $produto->id,
                'estoque_lote_id' => $lote?->id,
                'tipo' => $data['tipo'],
                'origem' => $data['origem'],
                'documento_ref' => $data['documento_ref'] ?: null,
                'quantidade' => $quantidade,
                'sinal' => $sinal,
                'saldo_apos' => $novoSaldo,
                'observacao' => $data['observacao'] ?? null,
                'user_id' => $request->user()?->id,
                'created_at' => now(),
            ]);
        });

        return redirect()->route('movimentacoes-estoque.index')->with('success', 'Movimentacao registrada com sucesso.');
    }

    public function lotesPorProduto(Produto $produto): JsonResponse
    {
        $lotes = EstoqueLote::query()
            ->where('produto_id', $produto->id)
            ->where('quantidade_disponivel', '>', 0)
            ->orderBy('validade')
            ->orderBy('lote')
            ->get(['id', 'lote', 'serial', 'validade', 'quantidade_disponivel']);

        return response()->json([
            'controla_lote' => (bool) $produto->controla_lote,
            'controla_validade' => (bool) $produto->controla_validade,
            'lotes' => $lotes,
        ]);
    }
}
