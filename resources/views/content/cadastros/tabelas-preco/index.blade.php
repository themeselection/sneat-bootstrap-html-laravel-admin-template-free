@extends('layouts/contentNavbarLayout')

@section('title', 'Tabelas de Preco')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <h4 class="mb-0">Tabelas de Preco</h4>
    @perm('cadastros_base.manage')
        <a href="{{ route('tabelas-preco.create') }}" class="btn btn-primary">Nova Tabela</a>
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
            <div class="col-md-5">
                <label class="form-label">Busca</label>
                <input type="text" name="busca" class="form-control" value="{{ $filtros['busca'] ?? '' }}" placeholder="Nome ou codigo">
            </div>
            <div class="col-md-3">
                <label class="form-label">Tipo</label>
                <select name="tipo" class="form-select">
                    <option value="">Todos</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo }}" @selected(($filtros['tipo'] ?? '') === $tipo)>{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="ativo" class="form-select">
                    <option value="">Todos</option>
                    <option value="1" @selected(($filtros['ativo'] ?? '') === '1')>Ativa</option>
                    <option value="0" @selected(($filtros['ativo'] ?? '') === '0')>Inativa</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('tabelas-preco.index') }}" class="btn btn-outline-secondary">Limpar</a>
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
                    <th>Codigo</th>
                    <th>Tipo</th>
                    <th>Prioridade</th>
                    <th>Status</th>
                    <th class="text-end">Acoes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tabelas as $tabela)
                    <tr>
                        <td>{{ $tabela->nome }}</td>
                        <td>{{ $tabela->codigo }}</td>
                        <td>{{ $tabela->tipo }}</td>
                        <td>{{ $tabela->prioridade }}</td>
                        <td><span class="badge bg-label-{{ $tabela->ativo ? 'success' : 'secondary' }}">{{ $tabela->ativo ? 'Ativa' : 'Inativa' }}</span></td>
                        <td class="text-end">
                            @perm('cadastros_base.manage')
                                <a href="{{ route('tabelas-preco.edit', $tabela) }}" class="btn btn-sm btn-outline-info">Editar</a>
                                <form method="POST" action="{{ route('tabelas-preco.destroy', $tabela) }}" class="d-inline" onsubmit="return confirm('Excluir tabela de preco?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            @endperm
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Nenhuma tabela encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($tabelas->hasPages())
        <div class="card-footer">{{ $tabelas->links() }}</div>
    @endif
</div>
@endsection
