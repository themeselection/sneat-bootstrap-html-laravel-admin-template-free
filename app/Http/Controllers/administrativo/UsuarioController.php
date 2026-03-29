<?php

namespace App\Http\Controllers\administrativo;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUsuarioAcessoRequest;
use App\Models\AuditoriaLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function index(Request $request): View
    {
        $this->assertPermission($request->user(), 'usuarios.view', 'Sem permissao para visualizar usuarios.');

        $query = User::query()->orderBy('name');

        if ($request->filled('busca')) {
            $busca = trim((string) $request->string('busca'));
            $query->where(function ($q) use ($busca) {
                $q->where('name', 'like', "%{$busca}%")
                    ->orWhere('email', 'like', "%{$busca}%");
            });
        }

        if ($request->filled('nivel_acesso')) {
            $query->where('nivel_acesso', (string) $request->string('nivel_acesso'));
        }

        return view('content.administrativo.usuarios.index', [
            'usuarios' => $query->paginate(20)->withQueryString(),
            'filtros' => $request->only(['busca', 'nivel_acesso']),
            'niveis' => ['OPERADOR', 'GERENTE', 'ADMIN'],
            'logsRecentes' => AuditoriaLog::query()
                ->with('usuario:id,name')
                ->where('acao', 'NIVEL_ACESSO_USUARIO')
                ->latest()
                ->limit(15)
                ->get(),
        ]);
    }

    public function updateAcesso(UpdateUsuarioAcessoRequest $request, User $user): RedirectResponse
    {
        $this->assertPermission($request->user(), 'usuarios.manage', 'Sem permissao para alterar acessos.');
        $this->assertAdmin($request->user());

        $nivelAnterior = (string) ($user->nivel_acesso ?? 'OPERADOR');
        $nivelNovo = (string) $request->validated('nivel_acesso');

        $user->update([
            'nivel_acesso' => $nivelNovo,
        ]);

        if ($nivelAnterior !== $nivelNovo) {
            AuditoriaLog::create([
                'usuario_id' => $request->user()->id,
                'acao' => 'NIVEL_ACESSO_USUARIO',
                'entidade_tipo' => 'USER',
                'entidade_id' => $user->id,
                'dados_antes' => [
                    'nome' => $user->name,
                    'email' => $user->email,
                    'nivel_acesso' => $nivelAnterior,
                ],
                'dados_depois' => [
                    'nome' => $user->name,
                    'email' => $user->email,
                    'nivel_acesso' => $nivelNovo,
                ],
                'ip' => $request->ip(),
                'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
            ]);
        }

        return redirect()
            ->route('usuarios.index')
            ->with('success', "Nivel de acesso de {$user->name} atualizado.");
    }

    public function permissoes(Request $request): View
    {
        $this->assertPermission($request->user(), 'usuarios.view', 'Sem permissao para visualizar permissoes.');

        $matriz = (array) config('rbac.permissions_by_role', []);
        ksort($matriz);

        return view('content.administrativo.usuarios.permissoes', [
            'matriz' => $matriz,
        ]);
    }

    private function assertAdmin(?User $user): void
    {
        if (!$user || (string) $user->nivel_acesso !== 'ADMIN') {
            abort(403, 'Apenas ADMIN pode gerir usuarios.');
        }
    }

    private function assertPermission(?User $user, string $permission, string $message): void
    {
        if (!$user || !$user->hasPermission($permission)) {
            abort(403, $message);
        }
    }
}
