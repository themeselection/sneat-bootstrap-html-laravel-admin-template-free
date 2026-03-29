<?php

namespace App\Http\Controllers\cadastros;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriaProdutoRequest;
use App\Http\Requests\UpdateCategoriaProdutoRequest;
use App\Models\CategoriaProduto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriaProdutoController extends Controller
{
    public function index(Request $request): View
    {
        $query = CategoriaProduto::query();

        if ($request->filled('busca')) {
            $busca = trim((string) $request->string('busca'));
            $query->where('nome', 'like', "%{$busca}%");
        }

        if ($request->filled('ativo')) {
            $query->where('ativo', (bool) $request->integer('ativo'));
        }

        return view('content.cadastros.categorias.index', [
            'categorias' => $query->orderBy('nome')->paginate(15)->withQueryString(),
            'filtros' => $request->only(['busca', 'ativo']),
        ]);
    }

    public function create(): View
    {
        return view('content.cadastros.categorias.create', [
            'categoriaProduto' => new CategoriaProduto(['ativo' => true]),
        ]);
    }

    public function store(StoreCategoriaProdutoRequest $request): RedirectResponse
    {
        CategoriaProduto::create($request->validated());

        return redirect()->route('categorias-produto.index')->with('success', 'Categoria criada com sucesso.');
    }

    public function edit(CategoriaProduto $categoriaProduto): View
    {
        return view('content.cadastros.categorias.edit', compact('categoriaProduto'));
    }

    public function update(UpdateCategoriaProdutoRequest $request, CategoriaProduto $categoriaProduto): RedirectResponse
    {
        $categoriaProduto->update($request->validated());

        return redirect()->route('categorias-produto.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(CategoriaProduto $categoriaProduto): RedirectResponse
    {
        if ($categoriaProduto->produtos()->exists()) {
            return redirect()->route('categorias-produto.index')->with('error', 'Nao e possivel excluir categoria com produtos vinculados.');
        }

        $categoriaProduto->delete();

        return redirect()->route('categorias-produto.index')->with('success', 'Categoria removida com sucesso.');
    }
}
