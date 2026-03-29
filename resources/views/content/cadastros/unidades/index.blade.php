@extends('layouts/contentNavbarLayout')

@section('title', 'Unidades de Medida')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <h4 class="mb-0">Unidades de Medida</h4>
    @perm('cadastros_base.manage')
        <a href="{{ route('unidades-medida.create') }}" class="btn btn-primary">Nova Unidade</a>
    @endperm
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card mb-6">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Busca</label>
                <input type="text" name="busca" class="form-control" value="{{ $filtros['busca'] ?? '' }}" placeholder="Sigla ou nome">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="ativo" class="form-select">
                    <option value="">Todos</option>
                    <option value="1" @selected(($filtros['ativo'] ?? '') === '1')>Ativa</option>
                    <option value="0" @selected(($filtros['ativo'] ?? '') === '0')>Inativa</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('unidades-medida.index') }}" class="btn btn-outline-secondary">Limpar</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Sigla</th>
                    <th>Nome</th>
                    <th>Casas Decimais</th>
                    <th>Status</th>
                    <th class="text-end">Acoes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($unidades as $unidade)
                    <tr>
                        <td>{{ $unidade->sigla }}</td>
                        <td>{{ $unidade->nome }}</td>
                        <td>{{ $unidade->casas_decimais }}</td>
                        <td><span class="badge bg-label-{{ $unidade->ativo ? 'success' : 'secondary' }}">{{ $unidade->ativo ? 'Ativa' : 'Inativa' }}</span></td>
                        <td class="text-end">
                            @perm('cadastros_base.manage')
                                <a href="{{ route('unidades-medida.edit', $unidade) }}" class="btn btn-sm btn-outline-info">Editar</a>
                                <form method="POST" action="{{ route('unidades-medida.destroy', $unidade) }}" class="d-inline" onsubmit="return confirm('Excluir unidade?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            @endperm
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Nenhuma unidade encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($unidades->hasPages())
        <div class="card-footer">{{ $unidades->links() }}</div>
    @endif
</div>
@endsection
