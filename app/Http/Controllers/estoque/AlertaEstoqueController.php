<?php

namespace App\Http\Controllers\estoque;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProduto;
use App\Models\EstoqueSaldo;
use App\Models\Filial;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlertaEstoqueController extends Controller
{
    public function index(Request $request): View
    {
        $query = EstoqueSaldo::query()
            ->with(['produto.categoria'])
            ->whereHas('produto', function (Builder $q) use ($request) {
                $q->where('ativo', true);

                if ($request->filled('categoria_id')) {
                    $q->where('categoria_id', (int) $request->integer('categoria_id'));
                }

                if ($request->filled('busca')) {
                    $busca = trim((string) $request->string('busca'));
                    $q->where(function (Builder $inner) use ($busca) {
                        $inner->where('nome', 'like', "%{$busca}%")
                            ->orWhere('sku', 'like', "%{$busca}%")
                            ->orWhere('codigo_barras', 'like', "%{$busca}%");
                    });
                }
            });

        $tipoAlerta = (string) $request->string('tipo_alerta');
        if ($tipoAlerta === 'RUPTURA') {
            $query->where('quantidade_atual', '<=', 0);
        } elseif ($tipoAlerta === 'BAIXO') {
            $query->whereColumn('quantidade_atual', '<=', 'estoque_minimo')
                ->where('quantidade_atual', '>', 0);
        } else {
            $query->whereColumn('quantidade_atual', '<=', 'estoque_minimo');
        }

        $saldos = $query->orderBy('quantidade_atual')->paginate(25)->withQueryString();

        return view('content.estoque.alertas.index', [
            'saldos' => $saldos,
            'filialReferencia' => Filial::query()->where('ativa', true)->orderBy('id')->value('nome') ?? 'Matriz',
            'categorias' => CategoriaProduto::query()->where('ativo', true)->orderBy('nome')->get(['id', 'nome']),
            'filtros' => $request->only(['busca', 'categoria_id', 'tipo_alerta']),
            'cards' => [
                'itens_monitorados' => (int) EstoqueSaldo::query()->count(),
                'baixo_estoque' => (int) EstoqueSaldo::query()->whereColumn('quantidade_atual', '<=', 'estoque_minimo')->where('quantidade_atual', '>', 0)->count(),
                'ruptura' => (int) EstoqueSaldo::query()->where('quantidade_atual', '<=', 0)->count(),
            ],
        ]);
    }
}
