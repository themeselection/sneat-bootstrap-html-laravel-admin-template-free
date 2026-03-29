@extends('layouts/contentNavbarLayout')

@section('title', 'Usuarios e Acessos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Gestao de Usuarios</h4>
        <p class="mb-0 text-muted">Somente ADMIN pode ajustar nivel de acesso.</p>
    </div>
    <a href="{{ route('usuarios.permissoes') }}" class="btn btn-outline-primary">Matriz de Permissoes</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card mb-6">
    <div class="card-body">
        <form method="GET" action="{{ route('usuarios.index') }}" class="row g-3">
            <div class="col-md-5">
                <label class="form-label" for="busca">Busca</label>
                <input id="busca" name="busca" type="text" class="form-control" value="{{ $filtros['busca'] ?? '' }}" placeholder="Nome ou email">
            </div>
            <div class="col-md-3">
                <label class="form-label" for="nivel_acesso">Nivel</label>
                <select id="nivel_acesso" name="nivel_acesso" class="form-select">
                    <option value="">Todos</option>
                    @foreach ($niveis as $nivel)
                        <option value="{{ $nivel }}" @selected(($filtros['nivel_acesso'] ?? '') === $nivel)>{{ $nivel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">Filtrar</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nivel Atual</th>
                    <th>Atualizar Nivel</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td><span class="badge bg-label-primary">{{ $usuario->nivel_acesso ?? 'OPERADOR' }}</span></td>
                        <td>
                            @perm('usuarios.manage')
                                <form method="POST" action="{{ route('usuarios.update-acesso', $usuario) }}" class="d-flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="nivel_acesso" class="form-select form-select-sm" style="max-width: 170px">
                                        @foreach ($niveis as $nivel)
                                            <option value="{{ $nivel }}" @selected(($usuario->nivel_acesso ?? 'OPERADOR') === $nivel)>{{ $nivel }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-outline-primary">Salvar</button>
                                </form>
                            @else
                                <small class="text-muted">Sem permissao para alterar.</small>
                            @endperm
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-5">Nenhum usuario encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($usuarios->hasPages())
        <div class="card-footer">{{ $usuarios->links() }}</div>
    @endif
</div>

<div class="card mt-6">
    <div class="card-header">
        <h5 class="mb-0">Auditoria Recente de Acessos</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Admin</th>
                    <th>Usuario</th>
                    <th>De</th>
                    <th>Para</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logsRecentes as $log)
                    <tr>
                        <td>{{ optional($log->created_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ $log->usuario?->name ?? 'Sistema' }}</td>
                        <td>{{ $log->dados_depois['nome'] ?? ('#' . $log->entidade_id) }}</td>
                        <td><span class="badge bg-label-secondary">{{ $log->dados_antes['nivel_acesso'] ?? '-' }}</span></td>
                        <td><span class="badge bg-label-primary">{{ $log->dados_depois['nivel_acesso'] ?? '-' }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Sem alteracoes recentes de nivel de acesso.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
