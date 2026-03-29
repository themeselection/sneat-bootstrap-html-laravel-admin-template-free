<?php

namespace App\Http\Controllers\administrativo;

use App\Http\Controllers\Controller;
use App\Models\AuditoriaLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditoriaController extends Controller
{
    public function index(Request $request): View
    {
        $this->assertAcessoGerencial($request->user());

        $query = $this->applyFilters(
            AuditoriaLog::query()->with('usuario:id,name')->latest(),
            $request
        );

        return view('content.administrativo.auditoria.index', [
            'logs' => $query->paginate(30)->withQueryString(),
            'filtros' => $request->only(['acao', 'entidade_tipo', 'usuario_id', 'data_inicio', 'data_fim']),
            'acoes' => AuditoriaLog::query()->select('acao')->distinct()->orderBy('acao')->pluck('acao')->values(),
            'entidades' => AuditoriaLog::query()->select('entidade_tipo')->distinct()->orderBy('entidade_tipo')->pluck('entidade_tipo')->values(),
            'usuarios' => User::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function exportCsv(Request $request): Response
    {
        $this->assertAcessoGerencial($request->user());

        $query = $this->applyFilters(
            AuditoriaLog::query()->with('usuario:id,name')->latest(),
            $request
        );

        $filename = 'auditoria_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        return response()->streamDownload(function () use ($query) {
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF");

            fputcsv($output, [
                'data_hora',
                'acao',
                'entidade_tipo',
                'entidade_id',
                'usuario',
                'dados_antes',
                'dados_depois',
                'ip',
                'user_agent',
            ], ';');

            $query->chunk(500, function ($logs) use ($output) {
                foreach ($logs as $log) {
                    fputcsv($output, [
                        optional($log->created_at)->format('Y-m-d H:i:s'),
                        $log->acao,
                        $log->entidade_tipo,
                        $log->entidade_id,
                        $log->usuario?->name ?? 'Sistema',
                        json_encode($log->dados_antes, JSON_UNESCAPED_UNICODE),
                        json_encode($log->dados_depois, JSON_UNESCAPED_UNICODE),
                        $log->ip,
                        $log->user_agent,
                    ], ';');
                }
            });

            fclose($output);
        }, $filename, $headers);
    }

    private function applyFilters($query, Request $request)
    {
        if ($request->filled('acao')) {
            $query->where('acao', (string) $request->string('acao'));
        }

        if ($request->filled('entidade_tipo')) {
            $query->where('entidade_tipo', (string) $request->string('entidade_tipo'));
        }

        if ($request->filled('usuario_id')) {
            $query->where('usuario_id', (int) $request->integer('usuario_id'));
        }

        if ($request->filled('data_inicio')) {
            $inicio = Carbon::parse((string) $request->string('data_inicio'))->startOfDay();
            $query->where('created_at', '>=', $inicio);
        }

        if ($request->filled('data_fim')) {
            $fim = Carbon::parse((string) $request->string('data_fim'))->endOfDay();
            $query->where('created_at', '<=', $fim);
        }

        return $query;
    }

    private function assertAcessoGerencial(?User $user): void
    {
        if (!$user || !$user->possuiAcessoGerencial()) {
            abort(403, 'Apenas GERENTE/ADMIN podem acessar auditoria.');
        }
    }
}
