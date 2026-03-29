<?php

namespace App\Http\Controllers\compras;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFornecedorRequest;
use App\Http\Requests\UpdateFornecedorRequest;
use App\Models\Fornecedor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FornecedorController extends Controller
{
    public function index(Request $request): View
    {
        $query = $this->buildIndexQuery($request);

        return view('content.compras.fornecedores.index', [
            'fornecedores' => $query->paginate(20)->withQueryString(),
            'filtros' => $request->only(['busca', 'ativo', 'tem_email', 'tem_telefone']),
        ]);
    }

    public function exportCsv(Request $request)
    {
        $fornecedores = $this->buildIndexQuery($request)->get();
        $fileName = 'fornecedores_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        return response()->stream(function () use ($fornecedores): void {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($out, [
                'ID',
                'Nome',
                'CNPJ',
                'Contato',
                'Telefone',
                'Email',
                'Status',
            ], ';');

            foreach ($fornecedores as $fornecedor) {
                fputcsv($out, [
                    $fornecedor->id,
                    $fornecedor->nome,
                    $fornecedor->cnpj ?? '',
                    $fornecedor->contato ?? '',
                    $fornecedor->telefone ?? '',
                    $fornecedor->email ?? '',
                    $fornecedor->ativo ? 'ATIVO' : 'INATIVO',
                ], ';');
            }

            fclose($out);
        }, 200, $headers);
    }

    public function create(): View
    {
        return view('content.compras.fornecedores.create', ['fornecedor' => new Fornecedor(), 'isEdit' => false]);
    }

    public function store(StoreFornecedorRequest $request): RedirectResponse
    {
        Fornecedor::create($request->validated());
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso.');
    }

    public function edit(Fornecedor $fornecedor): View
    {
        return view('content.compras.fornecedores.edit', compact('fornecedor') + ['isEdit' => true]);
    }

    public function update(UpdateFornecedorRequest $request, Fornecedor $fornecedor): RedirectResponse
    {
        $fornecedor->update($request->validated());
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso.');
    }

    public function destroy(Fornecedor $fornecedor): RedirectResponse
    {
        $fornecedor->delete();
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor removido.');
    }

    private function buildIndexQuery(Request $request)
    {
        $query = Fornecedor::query()->orderBy('nome');

        if ($request->filled('busca')) {
            $busca = trim((string) $request->string('busca'));
            $query->where(function ($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                    ->orWhere('cnpj', 'like', "%{$busca}%")
                    ->orWhere('email', 'like', "%{$busca}%")
                    ->orWhere('contato', 'like', "%{$busca}%")
                    ->orWhere('telefone', 'like', "%{$busca}%");
            });
        }

        if ($request->filled('ativo')) {
            $query->where('ativo', ((int) $request->input('ativo')) === 1);
        }

        if ($request->string('tem_email')->toString() === '1') {
            $query->whereNotNull('email')->where('email', '!=', '');
        }

        if ($request->string('tem_telefone')->toString() === '1') {
            $query->whereNotNull('telefone')->where('telefone', '!=', '');
        }

        return $query;
    }
}
