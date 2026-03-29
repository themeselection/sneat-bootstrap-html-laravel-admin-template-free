<?php

namespace App\Http\Controllers\compras;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompraRequest;
use App\Models\Compra;
use App\Models\EstoqueMovimentacao;
use App\Models\Filial;
use App\Models\Fornecedor;
use App\Models\Produto;
use App\Services\Compras\CompraService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompraController extends Controller
{
    public function __construct(private readonly CompraService $service)
    {
    }

    public function index(Request $request): View
    {
        $query = $this->buildIndexQuery($request);

        return view('content.compras.compras.index', [
            'compras' => $query->paginate(20)->withQueryString(),
            'fornecedores' => Fornecedor::query()->orderBy('nome')->get(['id', 'nome']),
            'filtros' => $request->only(['status', 'fornecedor_id', 'data_inicio', 'data_fim']),
        ]);
    }

    public function exportCsv(Request $request)
    {
        $compras = $this->buildIndexQuery($request)->get();
        $fileName = 'compras_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        return response()->stream(function () use ($compras): void {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($out, [
                'ID',
                'Numero',
                'Fornecedor',
                'Data',
                'Status',
                'Valor Total',
                'Conta Pagar Status',
                'Conta Pagar Aberto',
            ], ';');

            foreach ($compras as $compra) {
                fputcsv($out, [
                    $compra->id,
                    $compra->numero,
                    $compra->fornecedor->nome ?? '',
                    optional($compra->data_compra)->format('Y-m-d H:i:s'),
                    $compra->status,
                    number_format((float) $compra->valor_total, 2, '.', ''),
                    $compra->contaPagar->status ?? '',
                    number_format((float) ($compra->contaPagar->valor_aberto ?? 0), 2, '.', ''),
                ], ';');
            }

            fclose($out);
        }, 200, $headers);
    }

    public function create(): View
    {
        return view('content.compras.compras.create', [
            'fornecedores' => Fornecedor::query()->where('ativo', true)->orderBy('nome')->get(['id', 'nome']),
            'filiais' => Filial::query()->where('ativa', true)->orderBy('nome')->get(['id', 'nome']),
            'produtos' => Produto::query()->where('ativo', true)->where('permite_compra', true)->orderBy('nome')->get(['id', 'nome', 'sku']),
        ]);
    }

    public function store(StoreCompraRequest $request): RedirectResponse
    {
        $compra = $this->service->create($request->validated(), $request->user());

        return redirect()->route('compras.show', $compra)->with('success', 'Compra registrada com sucesso.');
    }

    public function show(Compra $compra): View
    {
        $compra->load(['fornecedor', 'usuario', 'filial', 'itens.produto', 'contaPagar']);
        $movimentacoes = EstoqueMovimentacao::query()
            ->with(['produto:id,nome,sku', 'lote:id,lote,serial'])
            ->where('origem_tipo', 'COMPRA')
            ->where('origem_id', $compra->id)
            ->orderByDesc('id')
            ->get();

        $analitico = [
            'itens_total' => $compra->itens->count(),
            'qtd_total' => (float) $compra->itens->sum('quantidade'),
            'ticket_medio_item' => $compra->itens->count() > 0
                ? round(((float) $compra->valor_total) / $compra->itens->count(), 2)
                : 0,
            'movimentos_estoque' => $movimentacoes->count(),
            'qtd_entrada_estoque' => (float) $movimentacoes->sum('quantidade'),
        ];

        return view('content.compras.compras.show', [
            'compra' => $compra,
            'movimentacoes' => $movimentacoes,
            'analitico' => $analitico,
        ]);
    }

    private function buildIndexQuery(Request $request)
    {
        $query = Compra::query()
            ->with(['fornecedor', 'usuario', 'contaPagar'])
            ->orderByDesc('id');

        if ($request->filled('status')) {
            $query->where('status', (string) $request->string('status'));
        }

        if ($request->filled('fornecedor_id')) {
            $query->where('fornecedor_id', (int) $request->integer('fornecedor_id'));
        }

        if ($request->filled('data_inicio')) {
            $query->whereDate('data_compra', '>=', $request->date('data_inicio'));
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('data_compra', '<=', $request->date('data_fim'));
        }

        return $query;
    }
}
