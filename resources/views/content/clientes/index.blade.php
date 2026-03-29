@extends('layouts/contentNavbarLayout')

@section('title', 'Clientes')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-6 gap-3">
    <div>
        <h4 class="mb-1">Clientes</h4>
        <p class="mb-0 text-muted">Gerencie o cadastro de clientes PF e PJ.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('clientes.export-csv', request()->query()) }}" class="btn btn-outline-primary">
            <i class="icon-base bx bx-download me-1"></i>Exportar CSV
        </a>
        @perm('clientes.manage')
            <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                <i class="icon-base bx bx-plus me-1"></i>Novo Cliente
            </a>
        @endperm
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card mb-6">
    <div class="card-body">
        <form method="GET" action="{{ route('clientes.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="busca" class="form-label">Busca</label>
                <input type="text" id="busca" name="busca" class="form-control" value="{{ $filtros['busca'] ?? '' }}" placeholder="Nome, documento, email ou telefone">
            </div>
            <div class="col-md-2">
                <label for="tipo_pessoa" class="form-label">Tipo</label>
                <select id="tipo_pessoa" name="tipo_pessoa" class="form-select">
                    <option value="">Todos</option>
                    <option value="PF" @selected(($filtros['tipo_pessoa'] ?? '') === 'PF')>PF</option>
                    <option value="PJ" @selected(($filtros['tipo_pessoa'] ?? '') === 'PJ')>PJ</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="uf" class="form-label">UF</label>
                <select id="uf" name="uf" class="form-select">
                    <option value="">Todas</option>
                    @foreach ($ufs as $sigla => $nomeUf)
                        <option value="{{ $sigla }}" @selected(($filtros['uf'] ?? '') === $sigla)>{{ $sigla }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="ativo" class="form-label">Situacao</label>
                <select id="ativo" name="ativo" class="form-select">
                    <option value="">Todos</option>
                    <option value="1" @selected(($filtros['ativo'] ?? '') === '1')>Ativo</option>
                    <option value="0" @selected(($filtros['ativo'] ?? '') === '0')>Inativo</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">Limpar</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Documento</th>
                    <th>Contato</th>
                    <th>Cidade/UF</th>
                    <th>Situacao</th>
                    <th class="text-end">Acoes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->codigo ?: '-' }}</td>
                        <td>
                            <div class="fw-semibold">{{ $cliente->nome }}</div>
                            @if ($cliente->nome_fantasia)
                                <small class="text-muted">{{ $cliente->nome_fantasia }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-label-{{ $cliente->tipo_pessoa === 'PJ' ? 'info' : 'primary' }}">{{ $cliente->tipo_pessoa }}</span>
                        </td>
                        <td>{{ $cliente->documento_formatado }}</td>
                        <td>
                            <div>{{ $cliente->email ?: '-' }}</div>
                            <small class="text-muted">{{ $cliente->celular ?: ($cliente->telefone ?: '-') }}</small>
                        </td>
                        <td>{{ $cliente->cidade ?: '-' }}{{ $cliente->uf ? '/'.$cliente->uf : '' }}</td>
                        <td>
                            <span class="badge bg-label-{{ $cliente->ativo ? 'success' : 'secondary' }}">{{ $cliente->ativo ? 'Ativo' : 'Inativo' }}</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                            @perm('clientes.manage')
                                <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-outline-info">Editar</a>
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja remover este cliente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Excluir</button>
                                </form>
                            @endperm
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">Nenhum cliente encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($clientes->hasPages())
        <div class="card-footer">
            {{ $clientes->links() }}
        </div>
    @endif
</div>
@endsection
