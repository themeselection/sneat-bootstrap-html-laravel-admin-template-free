<?php

namespace App\Http\Controllers\cadastros;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTabelaPrecoRequest;
use App\Http\Requests\UpdateTabelaPrecoRequest;
use App\Models\TabelaPreco;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TabelaPrecoController extends Controller
{
    public function index(Request $request): View
    {
        $query = TabelaPreco::query();

        if ($request->filled('busca')) {
            $busca = trim((string) $request->string('busca'));
            $query->where(function ($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                    ->orWhere('codigo', 'like', "%{$busca}%");
            });
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', (string) $request->string('tipo'));
        }

        if ($request->filled('ativo')) {
            $query->where('ativo', (bool) $request->integer('ativo'));
        }

        return view('content.cadastros.tabelas-preco.index', [
            'tabelas' => $query->orderBy('prioridade')->orderBy('nome')->paginate(15)->withQueryString(),
            'filtros' => $request->only(['busca', 'tipo', 'ativo']),
            'tipos' => ['VAREJO', 'ATACADO', 'PROMOCAO', 'ESPECIAL'],
        ]);
    }

    public function create(): View
    {
        return view('content.cadastros.tabelas-preco.create', [
            'tabelaPreco' => new TabelaPreco(['ativo' => true, 'tipo' => 'VAREJO', 'prioridade' => 0]),
            'tipos' => ['VAREJO', 'ATACADO', 'PROMOCAO', 'ESPECIAL'],
        ]);
    }

    public function store(StoreTabelaPrecoRequest $request): RedirectResponse
    {
        TabelaPreco::create($request->validated());

        return redirect()->route('tabelas-preco.index')->with('success', 'Tabela de preco criada com sucesso.');
    }

    public function edit(TabelaPreco $tabelaPreco): View
    {
        return view('content.cadastros.tabelas-preco.edit', [
            'tabelaPreco' => $tabelaPreco,
            'tipos' => ['VAREJO', 'ATACADO', 'PROMOCAO', 'ESPECIAL'],
        ]);
    }

    public function update(UpdateTabelaPrecoRequest $request, TabelaPreco $tabelaPreco): RedirectResponse
    {
        $tabelaPreco->update($request->validated());

        return redirect()->route('tabelas-preco.index')->with('success', 'Tabela de preco atualizada com sucesso.');
    }

    public function destroy(TabelaPreco $tabelaPreco): RedirectResponse
    {
        if ($tabelaPreco->produtoPrecos()->exists()) {
            return redirect()->route('tabelas-preco.index')->with('error', 'Nao e possivel excluir tabela vinculada a produtos.');
        }

        $tabelaPreco->delete();

        return redirect()->route('tabelas-preco.index')->with('success', 'Tabela de preco removida com sucesso.');
    }
}
