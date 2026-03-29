@extends('layouts/contentNavbarLayout')

@section('title', 'Movimentacoes de Estoque')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <h4 class="mb-0">Movimentacoes de Estoque</h4>
    @perm('estoque.movimentacoes.manage')
        <a href="{{ route('movimentacoes-estoque.create') }}" class="btn btn-primary">Nova Movimentacao</a>
    @endperm
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card mb-6">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Produto</label>
                <select name="produto_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach ($produtos as $produto)
                        <option value="{{ $produto->id }}" @selected((string) ($filtros['produto_id'] ?? '') === (string) $produto->id)>
                            {{ $produto->sku }} - {{ $produto->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tipo</label>
                <select name="tipo" class="form-select">
                    <option value="">Todos</option>
                    <option value="ENTRADA" @selected(($filtros['tipo'] ?? '') === 'ENTRADA')>Entrada</option>
                    <option value="SAIDA" @selected(($filtros['tipo'] ?? '') === 'SAIDA')>Saida</option>
                    <option value="AJUSTE" @selected(($filtros['tipo'] ?? '') === 'AJUSTE')>Ajuste</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('movimentacoes-estoque.index') }}" class="btn btn-outline-secondary">Limpar</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Produto</th>
                    <th>Tipo</th>
                    <th>Origem</th>
                    <th>Lote/Serial</th>
                    <th>Qtd</th>
                    <th>Saldo Apos</th>
                    <th>Ref.</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($movimentacoes as $mov)
                    <tr>
                        <td>{{ optional($mov->created_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ $mov->produto->sku }} - {{ $mov->produto->nome }}</td>
                        <td>
                            <span class="badge bg-label-{{ $mov->sinal > 0 ? 'success' : 'danger' }}">
                                {{ $mov->tipo }}
                            </span>
                        </td>
                        <td>{{ $mov->origem }}</td>
                        <td>{{ $mov->lote ? $mov->lote->lote . ($mov->lote->serial ? ' / '.$mov->lote->serial : '') : '-' }}</td>
                        <td>{{ $mov->sinal > 0 ? '+' : '-' }}{{ number_format((float) $mov->quantidade, 3, ',', '.') }}</td>
                        <td>{{ number_format((float) $mov->saldo_apos, 3, ',', '.') }}</td>
                        <td>{{ $mov->documento_ref ?: '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Sem movimentacoes registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($movimentacoes->hasPages())
        <div class="card-footer">{{ $movimentacoes->links() }}</div>
    @endif
</div>
@endsection
