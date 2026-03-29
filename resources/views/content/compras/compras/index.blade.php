@extends('layouts/contentNavbarLayout')

@section('title', 'Compras')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Compras</h4>
        <p class="mb-0 text-muted">Entradas de mercadorias com geração de estoque e contas a pagar.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('compras.export-csv', request()->query()) }}" class="btn btn-outline-primary">Exportar CSV</a>
        @perm('compras.compras.manage')
            <a href="{{ route('compras.create') }}" class="btn btn-primary">Nova Compra</a>
        @endperm
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card mb-6">
    <div class="card-body">
        <form method="GET" action="{{ route('compras.index') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Todos</option>
                    @foreach (['RASCUNHO','CONFIRMADA','CANCELADA'] as $status)
                        <option value="{{ $status }}" @selected(($filtros['status'] ?? '') === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fornecedor</label>
                <select name="fornecedor_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach ($fornecedores as $fornecedor)
                        <option value="{{ $fornecedor->id }}" @selected((string)($filtros['fornecedor_id'] ?? '') === (string)$fornecedor->id)>{{ $fornecedor->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Data início</label>
                <input type="date" name="data_inicio" class="form-control" value="{{ $filtros['data_inicio'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Data fim</label>
                <input type="date" name="data_fim" class="form-control" value="{{ $filtros['data_fim'] ?? '' }}">
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
                    <th>Número</th>
                    <th>Fornecedor</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Conta a Pagar</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($compras as $compra)
                    <tr>
                        <td>{{ $compra->numero }}</td>
                        <td>{{ $compra->fornecedor->nome }}</td>
                        <td>{{ optional($compra->data_compra)->format('d/m/Y H:i') }}</td>
                        <td><span class="badge bg-label-{{ $compra->status === 'CONFIRMADA' ? 'success' : 'secondary' }}">{{ $compra->status }}</span></td>
                        <td>R$ {{ number_format((float) $compra->valor_total, 2, ',', '.') }}</td>
                        <td>
                            @if ($compra->contaPagar)
                                {{ $compra->contaPagar->status }} • R$ {{ number_format((float) $compra->contaPagar->valor_aberto, 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('compras.show', $compra) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">Nenhuma compra encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($compras->hasPages())
        <div class="card-footer">{{ $compras->links() }}</div>
    @endif
</div>
@endsection
