@extends('layouts/contentNavbarLayout')

@section('title', 'Auditoria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Trilha de Auditoria</h4>
        <p class="mb-0 text-muted">Eventos críticos de vendas, pedidos, faturamento e acessos.</p>
    </div>
</div>

<div class="card mb-6">
    <div class="card-body">
        <form method="GET" action="{{ route('auditoria.index') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label" for="acao">Ação</label>
                <select id="acao" name="acao" class="form-select">
                    <option value="">Todas</option>
                    @foreach ($acoes as $acao)
                        <option value="{{ $acao }}" @selected(($filtros['acao'] ?? '') === $acao)>{{ $acao }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="entidade_tipo">Entidade</label>
                <select id="entidade_tipo" name="entidade_tipo" class="form-select">
                    <option value="">Todas</option>
                    @foreach ($entidades as $entidade)
                        <option value="{{ $entidade }}" @selected(($filtros['entidade_tipo'] ?? '') === $entidade)>{{ $entidade }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="usuario_id">Usuário</label>
                <select id="usuario_id" name="usuario_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" @selected((string) ($filtros['usuario_id'] ?? '') === (string) $usuario->id)>{{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label" for="data_inicio">Data início</label>
                <input type="date" id="data_inicio" name="data_inicio" class="form-control" value="{{ $filtros['data_inicio'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label class="form-label" for="data_fim">Data fim</label>
                <input type="date" id="data_fim" name="data_fim" class="form-control" value="{{ $filtros['data_fim'] ?? '' }}">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button class="btn btn-primary w-100">Filtrar</button>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <a
                    class="btn btn-outline-success w-100"
                    href="{{ route('auditoria.export-csv', request()->query()) }}">
                    Exportar CSV
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Data/Hora</th>
                    <th>Ação</th>
                    <th>Entidade</th>
                    <th>Usuário</th>
                    <th>Antes</th>
                    <th>Depois</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ optional($log->created_at)->format('d/m/Y H:i:s') }}</td>
                        <td><span class="badge bg-label-primary">{{ $log->acao }}</span></td>
                        <td>{{ $log->entidade_tipo }}#{{ $log->entidade_id }}</td>
                        <td>{{ $log->usuario?->name ?? 'Sistema' }}</td>
                        <td><small class="text-muted">{{ json_encode($log->dados_antes, JSON_UNESCAPED_UNICODE) }}</small></td>
                        <td><small class="text-muted">{{ json_encode($log->dados_depois, JSON_UNESCAPED_UNICODE) }}</small></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">Nenhum log encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($logs->hasPages())
        <div class="card-footer">{{ $logs->links() }}</div>
    @endif
</div>
@endsection
