<?php

namespace App\Http\Controllers\cadastros;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnidadeMedidaRequest;
use App\Http\Requests\UpdateUnidadeMedidaRequest;
use App\Models\UnidadeMedida;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UnidadeMedidaController extends Controller
{
    public function index(Request $request): View
    {
        $query = UnidadeMedida::query();

        if ($request->filled('busca')) {
            $busca = trim((string) $request->string('busca'));
            $query->where(function ($q) use ($busca) {
                $q->where('sigla', 'like', "%{$busca}%")
                    ->orWhere('nome', 'like', "%{$busca}%");
            });
        }

        if ($request->filled('ativo')) {
            $query->where('ativo', (bool) $request->integer('ativo'));
        }

        return view('content.cadastros.unidades.index', [
            'unidades' => $query->orderBy('sigla')->paginate(15)->withQueryString(),
            'filtros' => $request->only(['busca', 'ativo']),
        ]);
    }

    public function create(): View
    {
        return view('content.cadastros.unidades.create', [
            'unidadeMedida' => new UnidadeMedida(['ativo' => true, 'casas_decimais' => 3]),
        ]);
    }

    public function store(StoreUnidadeMedidaRequest $request): RedirectResponse
    {
        UnidadeMedida::create($request->validated());

        return redirect()->route('unidades-medida.index')->with('success', 'Unidade criada com sucesso.');
    }

    public function edit(UnidadeMedida $unidadeMedida): View
    {
        return view('content.cadastros.unidades.edit', compact('unidadeMedida'));
    }

    public function update(UpdateUnidadeMedidaRequest $request, UnidadeMedida $unidadeMedida): RedirectResponse
    {
        $unidadeMedida->update($request->validated());

        return redirect()->route('unidades-medida.index')->with('success', 'Unidade atualizada com sucesso.');
    }

    public function destroy(UnidadeMedida $unidadeMedida): RedirectResponse
    {
        if ($unidadeMedida->produtos()->exists()) {
            return redirect()->route('unidades-medida.index')->with('error', 'Nao e possivel excluir unidade vinculada a produtos.');
        }

        $unidadeMedida->delete();

        return redirect()->route('unidades-medida.index')->with('success', 'Unidade removida com sucesso.');
    }
}
