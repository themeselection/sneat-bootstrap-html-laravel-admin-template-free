@extends('layouts/contentNavbarLayout')

@section('title', 'Fornecedores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Fornecedores</h4>
        <p class="mb-0 text-muted">Cadastro e gestão da base de compras.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('fornecedores.export-csv', request()->query()) }}" class="btn btn-outline-primary">Exportar CSV</a>
        @perm('compras.fornecedores.manage')
            <a href="{{ route('fornecedores.create') }}" class="btn btn-primary">Novo Fornecedor</a>
        @endperm
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card mb-6">
    <div class="card-body">
        <form method="GET" action="{{ route('fornecedores.index') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Busca</label>
                <input type="text" class="form-control" name="busca" value="{{ $filtros['busca'] ?? '' }}" placeholder="Nome, CNPJ ou e-mail">
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="ativo" class="form-select">
                    <option value="">Todos</option>
                    <option value="1" @selected(($filtros['ativo'] ?? '') === '1')>Ativo</option>
                    <option value="0" @selected(($filtros['ativo'] ?? '') === '0')>Inativo</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Com email</label>
                <select name="tem_email" class="form-select">
                    <option value="">Todos</option>
                    <option value="1" @selected(($filtros['tem_email'] ?? '') === '1')>Sim</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Com telefone</label>
                <select name="tem_telefone" class="form-select">
                    <option value="">Todos</option>
                    <option value="1" @selected(($filtros['tem_telefone'] ?? '') === '1')>Sim</option>
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
                    <th>CNPJ</th>
                    <th>Contato</th>
                    <th>Status</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fornecedores as $fornecedor)
                    <tr>
                        <td>{{ $fornecedor->nome }}</td>
                        <td>{{ $fornecedor->cnpj ?: '-' }}</td>
                        <td>{{ $fornecedor->contato ?: '-' }} {{ $fornecedor->telefone ? '• '.$fornecedor->telefone : '' }}</td>
                        <td><span class="badge bg-label-{{ $fornecedor->ativo ? 'success' : 'secondary' }}">{{ $fornecedor->ativo ? 'ATIVO' : 'INATIVO' }}</span></td>
                        <td class="text-end">
                            @perm('compras.fornecedores.manage')
                                <a href="{{ route('fornecedores.edit', $fornecedor) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form method="POST" action="{{ route('fornecedores.destroy', $fornecedor) }}" class="d-inline" onsubmit="return confirm('Remover fornecedor?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            @endperm
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">Nenhum fornecedor encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($fornecedores->hasPages())
        <div class="card-footer">{{ $fornecedores->links() }}</div>
    @endif
</div>
@endsection
