<?php

namespace App\Http\Controllers\financeiro;

use App\Http\Controllers\Controller;
use App\Models\AuditoriaLog;
use App\Models\ContaPagar;
use App\Models\ContaPagarMovimento;
use App\Models\Fornecedor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ContaPagarController extends Controller
{
    public function index(Request $request): View
    {
        $query = $this->buildIndexQuery($request);

        $contas = $query->paginate(20)->withQueryString();

        $cards = [
            'aberto_total' => (float) ContaPagar::whereIn('status', ['ABERTO', 'PARCIAL'])->sum('valor_aberto'),
            'atrasado_total' => (float) ContaPagar::whereIn('status', ['ABERTO', 'PARCIAL'])->whereDate('vencimento', '<', now()->toDateString())->sum('valor_aberto'),
            'pago_mes' => (float) ContaPagarMovimento::where('tipo', 'PAGAMENTO')->whereMonth('data_movimento', now()->month)->whereYear('data_movimento', now()->year)->sum('valor'),
        ];

        return view('content.financeiro.contas-pagar.index', [
            'contas' => $contas,
            'fornecedores' => Fornecedor::query()->orderBy('nome')->get(['id', 'nome']),
            'cards' => $cards,
            'filtros' => $request->only(['status', 'fornecedor_id', 'vencimento_inicio', 'vencimento_fim', 'somente_atrasadas']),
        ]);
    }

    public function show(ContaPagar $conta): View
    {
        $conta->load([
            'fornecedor:id,nome,cnpj,email,telefone',
            'compra:id,numero,data_compra,status,valor_total',
            'movimentos.usuario:id,name',
        ]);

        return view('content.financeiro.contas-pagar.show', [
            'conta' => $conta,
        ]);
    }

    public function exportExtratoCsv(ContaPagar $conta)
    {
        $request = request();
        $conta->load(['fornecedor:id,nome', 'movimentos.usuario:id,name']);
        $fileName = 'conta_pagar_extrato_' . $conta->id . '_' . now()->format('Ymd_His') . '.csv';

        AuditoriaLog::create([
            'usuario_id' => $request->user()?->id,
            'acao' => 'CONTA_PAGAR_EXTRATO_EXPORT_CSV',
            'entidade_tipo' => 'CONTA_PAGAR',
            'entidade_id' => $conta->id,
            'dados_antes' => null,
            'dados_depois' => ['movimentos' => $conta->movimentos->count()],
            'ip' => $request->ip(),
            'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
        ]);

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        return response()->stream(function () use ($conta): void {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($out, ['Conta', 'Fornecedor', 'Status', 'Valor Original', 'Valor Aberto'], ';');
            fputcsv($out, [
                $conta->id,
                $conta->fornecedor->nome ?? '',
                $conta->status,
                number_format((float) $conta->valor_original, 2, '.', ''),
                number_format((float) $conta->valor_aberto, 2, '.', ''),
            ], ';');
            fputcsv($out, [], ';');

            fputcsv($out, ['Data', 'Tipo', 'Valor', 'Forma', 'Usuario', 'Observacao'], ';');
            foreach ($conta->movimentos->sortByDesc('data_movimento') as $mov) {
                fputcsv($out, [
                    optional($mov->data_movimento)->format('Y-m-d H:i:s'),
                    $mov->tipo,
                    number_format((float) $mov->valor, 2, '.', ''),
                    $mov->forma_pagamento ?? '',
                    $mov->usuario->name ?? 'Sistema',
                    $mov->observacao ?? '',
                ], ';');
            }

            fclose($out);
        }, 200, $headers);
    }

    public function exportCsv(Request $request)
    {
        $contas = $this->buildIndexQuery($request)->get();
        $fileName = 'contas_pagar_' . now()->format('Ymd_His') . '.csv';

        AuditoriaLog::create([
            'usuario_id' => $request->user()?->id,
            'acao' => 'CONTAS_PAGAR_EXPORT_CSV',
            'entidade_tipo' => 'CONTA_PAGAR',
            'entidade_id' => null,
            'dados_antes' => null,
            'dados_depois' => ['quantidade' => $contas->count(), 'filtros' => $request->query()],
            'ip' => $request->ip(),
            'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
        ]);

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        return response()->stream(function () use ($contas): void {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($out, [
                'ID',
                'Compra',
                'Fornecedor',
                'Vencimento',
                'Valor Original',
                'Valor Aberto',
                'Status',
            ], ';');

            foreach ($contas as $conta) {
                fputcsv($out, [
                    $conta->id,
                    $conta->compra->numero ?? '',
                    $conta->fornecedor->nome ?? '',
                    optional($conta->vencimento)->format('Y-m-d'),
                    number_format((float) $conta->valor_original, 2, '.', ''),
                    number_format((float) $conta->valor_aberto, 2, '.', ''),
                    $conta->status,
                ], ';');
            }

            fclose($out);
        }, 200, $headers);
    }

    public function pagar(Request $request, ContaPagar $conta): RedirectResponse
    {
        $data = $request->validate([
            'valor' => ['required', 'numeric', 'min:0.01'],
            'forma_pagamento' => ['nullable', 'string', 'max:50'],
            'observacao' => ['nullable', 'string', 'max:500'],
            'data_movimento' => ['nullable', 'date'],
        ]);

        DB::transaction(function () use ($request, $conta, $data): void {
            $valor = round((float) $data['valor'], 2);
            $abertoAtual = round((float) $conta->valor_aberto, 2);

            if ($conta->status === 'CANCELADO') {
                abort(422, 'Conta cancelada nao pode receber pagamento.');
            }

            if ($abertoAtual <= 0) {
                abort(422, 'Conta ja quitada.');
            }

            if ($valor > $abertoAtual) {
                abort(422, 'Valor informado excede o valor em aberto.');
            }

            $novoAberto = round($abertoAtual - $valor, 2);
            $conta->update([
                'valor_aberto' => $novoAberto,
                'status' => $novoAberto <= 0 ? 'QUITADO' : 'PARCIAL',
            ]);

            ContaPagarMovimento::create([
                'conta_pagar_id' => $conta->id,
                'usuario_id' => $request->user()?->id,
                'tipo' => 'PAGAMENTO',
                'valor' => $valor,
                'data_movimento' => $data['data_movimento'] ?? now(),
                'forma_pagamento' => $data['forma_pagamento'] ?? null,
                'observacao' => $data['observacao'] ?? null,
            ]);

            AuditoriaLog::create([
                'usuario_id' => $request->user()?->id,
                'acao' => 'CONTA_PAGAR_PAGAMENTO',
                'entidade_tipo' => 'CONTA_PAGAR',
                'entidade_id' => $conta->id,
                'dados_antes' => ['valor_aberto' => $abertoAtual, 'status' => $conta->getOriginal('status')],
                'dados_depois' => ['valor_aberto' => $novoAberto, 'status' => $conta->status, 'valor_pagamento' => $valor],
                'ip' => $request->ip(),
                'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
            ]);
        });

        return back()->with('success', 'Pagamento registrado com sucesso.');
    }

    public function estornar(Request $request, ContaPagar $conta): RedirectResponse
    {
        $data = $request->validate([
            'valor' => ['required', 'numeric', 'min:0.01'],
            'observacao' => ['nullable', 'string', 'max:500'],
            'data_movimento' => ['nullable', 'date'],
        ]);

        DB::transaction(function () use ($request, $conta, $data): void {
            $valor = round((float) $data['valor'], 2);
            $abertoAtual = round((float) $conta->valor_aberto, 2);
            $original = round((float) $conta->valor_original, 2);

            if ($conta->status === 'CANCELADO') {
                abort(422, 'Conta cancelada nao pode ser estornada.');
            }

            if (($abertoAtual + $valor) > $original) {
                abort(422, 'Estorno excede o valor original da conta.');
            }

            $novoAberto = round($abertoAtual + $valor, 2);
            $conta->update([
                'valor_aberto' => $novoAberto,
                'status' => $novoAberto <= 0 ? 'QUITADO' : 'ABERTO',
            ]);

            ContaPagarMovimento::create([
                'conta_pagar_id' => $conta->id,
                'usuario_id' => $request->user()?->id,
                'tipo' => 'ESTORNO',
                'valor' => $valor,
                'data_movimento' => $data['data_movimento'] ?? now(),
                'forma_pagamento' => null,
                'observacao' => $data['observacao'] ?? null,
            ]);

            AuditoriaLog::create([
                'usuario_id' => $request->user()?->id,
                'acao' => 'CONTA_PAGAR_ESTORNO',
                'entidade_tipo' => 'CONTA_PAGAR',
                'entidade_id' => $conta->id,
                'dados_antes' => ['valor_aberto' => $abertoAtual, 'status' => $conta->getOriginal('status')],
                'dados_depois' => ['valor_aberto' => $novoAberto, 'status' => $conta->status, 'valor_estorno' => $valor],
                'ip' => $request->ip(),
                'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
            ]);
        });

        return back()->with('success', 'Estorno registrado com sucesso.');
    }

    private function buildIndexQuery(Request $request)
    {
        $query = ContaPagar::query()
            ->with(['fornecedor:id,nome', 'compra:id,numero'])
            ->orderBy('vencimento')
            ->orderByDesc('id');

        if ($request->filled('status')) {
            $query->where('status', (string) $request->string('status'));
        }

        if ($request->filled('fornecedor_id')) {
            $query->where('fornecedor_id', (int) $request->integer('fornecedor_id'));
        }

        if ($request->filled('vencimento_inicio')) {
            $query->whereDate('vencimento', '>=', $request->date('vencimento_inicio'));
        }

        if ($request->filled('vencimento_fim')) {
            $query->whereDate('vencimento', '<=', $request->date('vencimento_fim'));
        }

        if ($request->boolean('somente_atrasadas')) {
            $query->whereIn('status', ['ABERTO', 'PARCIAL'])
                ->whereDate('vencimento', '<', now()->toDateString());
        }

        return $query;
    }
}
