<?php

namespace App\Http\Controllers\financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaixaContaReceberRequest;
use App\Http\Requests\EstornoContaReceberRequest;
use App\Models\AuditoriaLog;
use App\Models\Cliente;
use App\Models\ContaReceber;
use App\Models\ContaReceberMovimento;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ContaReceberController extends Controller
{
    public function index(Request $request): View
    {
        $query = $this->buildIndexQuery($request);

        return view('content.financeiro.contas-receber.index', [
            'contas' => $query->paginate(20)->withQueryString(),
            'clientes' => Cliente::query()->orderBy('nome')->get(['id', 'nome']),
            'filtros' => $request->only(['status', 'cliente_id', 'vencimento_inicio', 'vencimento_fim', 'somente_atrasadas']),
            'cards' => [
                'aberto_total' => (float) ContaReceber::query()->whereIn('status', ['ABERTO', 'PARCIAL'])->sum('valor_aberto'),
                'atrasado_total' => (float) ContaReceber::query()->whereIn('status', ['ABERTO', 'PARCIAL'])->whereDate('vencimento', '<', now()->toDateString())->sum('valor_aberto'),
                'recebido_mes' => (float) ContaReceberMovimento::query()->where('tipo', 'RECEBIMENTO')->whereMonth('data_movimento', now()->month)->sum('valor'),
            ],
        ]);
    }

    public function show(ContaReceber $conta): View
    {
        $conta->load(['cliente', 'documento', 'movimentos.usuario']);

        return view('content.financeiro.contas-receber.show', [
            'conta' => $conta,
        ]);
    }

    public function exportExtratoCsv(ContaReceber $conta)
    {
        $request = request();
        $conta->load(['cliente', 'documento', 'movimentos.usuario']);
        $fileName = 'conta_receber_extrato_' . $conta->id . '_' . now()->format('Ymd_His') . '.csv';

        AuditoriaLog::create([
            'usuario_id' => $request->user()?->id,
            'acao' => 'CONTA_RECEBER_EXTRATO_EXPORT_CSV',
            'entidade_tipo' => 'CONTA_RECEBER',
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

            fputcsv($out, ['Conta', 'Documento', 'Cliente', 'Status', 'Valor Original', 'Valor Aberto'], ';');
            fputcsv($out, [
                $conta->id,
                $conta->documento->numero ?? '',
                $conta->cliente->nome ?? '',
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
        $fileName = 'contas_receber_' . now()->format('Ymd_His') . '.csv';

        AuditoriaLog::create([
            'usuario_id' => $request->user()?->id,
            'acao' => 'CONTAS_RECEBER_EXPORT_CSV',
            'entidade_tipo' => 'CONTA_RECEBER',
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
                'Documento',
                'Cliente',
                'Vencimento',
                'Valor Original',
                'Valor Aberto',
                'Status',
            ], ';');

            foreach ($contas as $conta) {
                fputcsv($out, [
                    $conta->id,
                    $conta->documento->numero ?? '',
                    $conta->cliente->nome ?? '',
                    optional($conta->vencimento)->format('Y-m-d'),
                    number_format((float) $conta->valor_original, 2, '.', ''),
                    number_format((float) $conta->valor_aberto, 2, '.', ''),
                    $conta->status,
                ], ';');
            }

            fclose($out);
        }, 200, $headers);
    }

    public function baixar(BaixaContaReceberRequest $request, ContaReceber $conta): RedirectResponse
    {
        $dados = $request->validated();

        DB::transaction(function () use ($conta, $dados, $request) {
            $valorBaixa = (float) $dados['valor'];
            $valorAbertoAtual = (float) $conta->valor_aberto;

            if ($conta->status === 'QUITADO') {
                throw ValidationException::withMessages(['valor' => 'Conta ja esta quitada.']);
            }
            if ($valorBaixa > $valorAbertoAtual) {
                throw ValidationException::withMessages(['valor' => 'Valor da baixa nao pode ser maior que o valor em aberto.']);
            }

            $novoAberto = round(max(0, $valorAbertoAtual - $valorBaixa), 2);
            $novoStatus = $novoAberto <= 0 ? 'QUITADO' : 'PARCIAL';

            $conta->update([
                'valor_aberto' => $novoAberto,
                'status' => $novoStatus,
            ]);

            ContaReceberMovimento::create([
                'conta_receber_id' => $conta->id,
                'usuario_id' => $request->user()->id,
                'tipo' => 'RECEBIMENTO',
                'valor' => $valorBaixa,
                'data_movimento' => $dados['data_movimento'],
                'forma_pagamento' => $dados['forma_pagamento'] ?? null,
                'observacao' => $dados['observacao'] ?? null,
            ]);

            AuditoriaLog::create([
                'usuario_id' => $request->user()->id,
                'acao' => 'CONTA_RECEBER_BAIXA',
                'entidade_tipo' => 'CONTA_RECEBER',
                'entidade_id' => $conta->id,
                'dados_antes' => ['valor_aberto' => $valorAbertoAtual, 'status' => $conta->getOriginal('status')],
                'dados_depois' => ['valor_aberto' => $novoAberto, 'status' => $novoStatus, 'valor_baixa' => $valorBaixa],
                'ip' => $request->ip(),
                'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
            ]);
        });

        return back()->with('success', 'Baixa registrada com sucesso.');
    }

    public function estornar(EstornoContaReceberRequest $request, ContaReceber $conta): RedirectResponse
    {
        $this->assertAcessoGerencial($request->user());
        $dados = $request->validated();

        DB::transaction(function () use ($conta, $dados, $request) {
            $valorEstorno = (float) $dados['valor'];
            $valorAbertoAtual = (float) $conta->valor_aberto;
            $valorOriginal = (float) $conta->valor_original;
            $valorPago = max(0, $valorOriginal - $valorAbertoAtual);

            if ($valorPago <= 0) {
                throw ValidationException::withMessages(['valor' => 'Nao existe valor pago para estornar nesta conta.']);
            }
            if ($valorEstorno > $valorPago) {
                throw ValidationException::withMessages(['valor' => 'Valor do estorno nao pode ser maior que o total pago.']);
            }

            $novoAberto = round(min($valorOriginal, $valorAbertoAtual + $valorEstorno), 2);
            $novoStatus = $novoAberto >= $valorOriginal ? 'ABERTO' : 'PARCIAL';

            $conta->update([
                'valor_aberto' => $novoAberto,
                'status' => $novoStatus,
            ]);

            ContaReceberMovimento::create([
                'conta_receber_id' => $conta->id,
                'usuario_id' => $request->user()->id,
                'tipo' => 'ESTORNO',
                'valor' => $valorEstorno,
                'data_movimento' => $dados['data_movimento'],
                'forma_pagamento' => null,
                'observacao' => $dados['observacao'],
            ]);

            AuditoriaLog::create([
                'usuario_id' => $request->user()->id,
                'acao' => 'CONTA_RECEBER_ESTORNO',
                'entidade_tipo' => 'CONTA_RECEBER',
                'entidade_id' => $conta->id,
                'dados_antes' => ['valor_aberto' => $valorAbertoAtual, 'status' => $conta->getOriginal('status')],
                'dados_depois' => ['valor_aberto' => $novoAberto, 'status' => $novoStatus, 'valor_estorno' => $valorEstorno],
                'ip' => $request->ip(),
                'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
            ]);
        });

        return back()->with('success', 'Estorno registrado com sucesso.');
    }

    private function assertAcessoGerencial(?User $user): void
    {
        if (!$user || !$user->possuiAcessoGerencial()) {
            abort(403, 'Apenas GERENTE/ADMIN podem estornar contas.');
        }
    }

    private function buildIndexQuery(Request $request)
    {
        $query = ContaReceber::query()
            ->with(['cliente', 'documento', 'movimentos.usuario'])
            ->orderByDesc('vencimento');

        if ($request->filled('status')) {
            $query->where('status', (string) $request->string('status'));
        }
        if ($request->filled('cliente_id')) {
            $query->where('cliente_id', (int) $request->integer('cliente_id'));
        }
        if ($request->filled('vencimento_inicio')) {
            $query->whereDate('vencimento', '>=', (string) $request->string('vencimento_inicio'));
        }
        if ($request->filled('vencimento_fim')) {
            $query->whereDate('vencimento', '<=', (string) $request->string('vencimento_fim'));
        }
        if ($request->boolean('somente_atrasadas')) {
            $query->whereIn('status', ['ABERTO', 'PARCIAL'])->whereDate('vencimento', '<', now()->toDateString());
        }

        return $query;
    }
}
