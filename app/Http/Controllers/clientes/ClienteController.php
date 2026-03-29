<?php

namespace App\Http\Controllers\clientes;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use App\Models\ContaReceber;
use App\Models\DocumentoComercial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ClienteController extends Controller
{
    public function index(Request $request): View
    {
        $query = $this->buildIndexQuery($request);
        $clientes = $query->orderByDesc('id')->paginate(15)->withQueryString();

        return view('content.clientes.index', [
            'clientes' => $clientes,
            'ufs' => config('brasil.ufs'),
            'filtros' => $request->only(['busca', 'tipo_pessoa', 'uf', 'ativo']),
        ]);
    }

    public function exportCsv(Request $request)
    {
        $clientes = $this->buildIndexQuery($request)->orderByDesc('id')->get();
        $fileName = 'clientes_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        return response()->stream(function () use ($clientes): void {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($out, [
                'ID',
                'Nome',
                'Tipo',
                'CPF/CNPJ',
                'Email',
                'Telefone',
                'Celular',
                'Cidade',
                'UF',
                'Status',
            ], ';');

            foreach ($clientes as $cliente) {
                fputcsv($out, [
                    $cliente->id,
                    $cliente->nome,
                    $cliente->tipo_pessoa,
                    $cliente->cpf_cnpj,
                    $cliente->email ?? '',
                    $cliente->telefone ?? '',
                    $cliente->celular ?? '',
                    $cliente->cidade ?? '',
                    $cliente->uf ?? '',
                    $cliente->ativo ? 'ATIVO' : 'INATIVO',
                ], ';');
            }

            fclose($out);
        }, 200, $headers);
    }

    public function create(): View
    {
        return view('content.clientes.create', [
            'cliente' => new Cliente([
                'tipo_pessoa' => 'PF',
                'ativo' => true,
                'pais' => 'Brasil',
                'sexo' => 'N',
                'saldo_credito' => 0,
                'limite_prazo' => 0,
            ]),
            'ufs' => config('brasil.ufs'),
            'cidades' => [],
        ]);
    }

    public function store(StoreClienteRequest $request): RedirectResponse
    {
        $cliente = Cliente::create($this->sanitizePayload($request->validated()));

        return redirect()
            ->route('clientes.show', $cliente)
            ->with('success', 'Cliente cadastrado com sucesso.');
    }

    public function show(Cliente $cliente): View
    {
        $resumoComercial = [
            'documentos_total' => DocumentoComercial::where('cliente_id', $cliente->id)->count(),
            'vendas_faturadas' => DocumentoComercial::where('cliente_id', $cliente->id)->where('status', 'FATURADO')->count(),
            'ultima_venda' => DocumentoComercial::where('cliente_id', $cliente->id)->where('status', 'FATURADO')->max('data_emissao'),
            'receber_em_aberto' => (float) ContaReceber::where('cliente_id', $cliente->id)->whereIn('status', ['ABERTO', 'PARCIAL'])->sum('valor_aberto'),
        ];

        return view('content.clientes.show', compact('cliente', 'resumoComercial'));
    }

    public function edit(Cliente $cliente): View
    {
        return view('content.clientes.edit', [
            'cliente' => $cliente,
            'ufs' => config('brasil.ufs'),
            'cidades' => $cliente->uf ? $this->getCidadesByUf($cliente->uf) : [],
        ]);
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente): RedirectResponse
    {
        $cliente->update($this->sanitizePayload($request->validated()));

        return redirect()
            ->route('clientes.show', $cliente)
            ->with('success', 'Cliente atualizado com sucesso.');
    }

    public function destroy(Cliente $cliente): RedirectResponse
    {
        $cliente->delete();

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente removido com sucesso.');
    }

    public function buscarCnpj(string $cnpj): JsonResponse
    {
        $cnpjDigits = preg_replace('/\D/', '', $cnpj);

        if (strlen($cnpjDigits) !== 14) {
            return response()->json(['message' => 'CNPJ invalido.'], 422);
        }

        $response = Http::timeout(10)->get("https://brasilapi.com.br/api/cnpj/v1/{$cnpjDigits}");

        if (!$response->successful()) {
            return response()->json(['message' => 'Nao foi possivel consultar o CNPJ agora.'], 422);
        }

        $data = $response->json();

        return response()->json([
            'nome' => $data['razao_social'] ?? null,
            'nome_fantasia' => $data['nome_fantasia'] ?? null,
            'email' => $data['email'] ?? null,
            'telefone' => $data['ddd_telefone_1'] ?? null,
            'cep' => $data['cep'] ?? null,
            'logradouro' => $data['logradouro'] ?? null,
            'numero' => $data['numero'] ?? null,
            'complemento' => $data['complemento'] ?? null,
            'bairro' => $data['bairro'] ?? null,
            'cidade' => $data['municipio'] ?? null,
            'uf' => $data['uf'] ?? null,
            'codigo_ibge' => $data['codigo_municipio_ibge'] ?? null,
            'pais' => 'Brasil',
        ]);
    }

    public function cidadesPorUf(string $uf): JsonResponse
    {
        $uf = strtoupper($uf);
        $cidades = $this->getCidadesByUf($uf);

        return response()->json(['cidades' => $cidades]);
    }

    private function sanitizePayload(array $data): array
    {
        $nullableFields = [
            'codigo',
            'nome_fantasia',
            'rg_ie',
            'email',
            'telefone',
            'celular',
            'contato_nome',
            'cep',
            'logradouro',
            'numero',
            'complemento',
            'bairro',
            'cidade',
            'uf',
            'codigo_ibge',
            'data_nascimento_fundacao',
            'sexo',
            'observacoes',
        ];

        foreach ($nullableFields as $field) {
            if (array_key_exists($field, $data) && $data[$field] === '') {
                $data[$field] = null;
            }
        }

        $data['ativo'] = (bool) ($data['ativo'] ?? true);
        $data['saldo_credito'] = $data['saldo_credito'] ?? 0;
        $data['limite_prazo'] = $data['limite_prazo'] ?? 0;
        $data['pais'] = $data['pais'] ?? 'Brasil';

        if (($data['tipo_pessoa'] ?? null) === 'PF') {
            $data['nome_fantasia'] = null;
            $data['contato_nome'] = null;
        }

        return $data;
    }

    private function getCidadesByUf(string $uf): array
    {
        if (!array_key_exists($uf, config('brasil.ufs'))) {
            return [];
        }

        return Cache::remember("ibge-cidades-{$uf}", now()->addDays(30), function () use ($uf) {
            $response = Http::timeout(10)->get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$uf}/municipios");

            if (!$response->successful()) {
                return [];
            }

            return collect($response->json())
                ->pluck('nome')
                ->filter()
                ->sort()
                ->values()
                ->all();
        });
    }

    private function buildIndexQuery(Request $request)
    {
        $query = Cliente::query();

        if ($request->filled('busca')) {
            $busca = trim((string) $request->string('busca'));
            $doc = preg_replace('/\D/', '', $busca);

            $query->where(function ($q) use ($busca, $doc) {
                $q->where('nome', 'like', "%{$busca}%")
                    ->orWhere('email', 'like', "%{$busca}%")
                    ->orWhere('telefone', 'like', "%{$doc}%")
                    ->orWhere('celular', 'like', "%{$doc}%")
                    ->orWhere('cpf_cnpj', 'like', "%{$doc}%");
            });
        }

        if ($request->filled('tipo_pessoa')) {
            $query->where('tipo_pessoa', $request->string('tipo_pessoa'));
        }

        if ($request->filled('uf')) {
            $query->where('uf', strtoupper((string) $request->string('uf')));
        }

        if ($request->filled('ativo')) {
            $query->where('ativo', (bool) $request->integer('ativo'));
        }

        return $query;
    }
}
