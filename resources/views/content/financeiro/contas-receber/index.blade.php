@extends('layouts/contentNavbarLayout')

@section('title', 'Contas a Receber')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Financeiro - Contas a Receber</h4>
        <p class="mb-0 text-muted">Baixa, estorno e conciliação rápida de recebimentos.</p>
    </div>
    <a href="{{ route('contas-receber.export-csv', request()->query()) }}" class="btn btn-outline-primary">Exportar CSV</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<div class="row g-4 mb-6">
    <div class="col-md-4"><div class="card border-start border-primary border-3"><div class="card-body"><small class="text-muted">Em aberto</small><h4 class="mb-0">R$ {{ number_format($cards['aberto_total'], 2, ',', '.') }}</h4></div></div></div>
    <div class="col-md-4"><div class="card border-start border-danger border-3"><div class="card-body"><small class="text-muted">Atrasado</small><h4 class="mb-0">R$ {{ number_format($cards['atrasado_total'], 2, ',', '.') }}</h4></div></div></div>
    <div class="col-md-4"><div class="card border-start border-success border-3"><div class="card-body"><small class="text-muted">Recebido no mês</small><h4 class="mb-0">R$ {{ number_format($cards['recebido_mes'], 2, ',', '.') }}</h4></div></div></div>
</div>

<div class="card mb-6">
    <div class="card-body">
        <form method="GET" action="{{ route('contas-receber.index') }}" class="row g-3">
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Todos</option>
                    @foreach (['ABERTO','PARCIAL','QUITADO','CANCELADO'] as $status)
                        <option value="{{ $status }}" @selected(($filtros['status'] ?? '') === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Cliente</label>
                <select name="cliente_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" @selected((string) ($filtros['cliente_id'] ?? '') === (string) $cliente->id)>{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Venc. início</label>
                <input type="date" name="vencimento_inicio" class="form-control" value="{{ $filtros['vencimento_inicio'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Venc. fim</label>
                <input type="date" name="vencimento_fim" class="form-control" value="{{ $filtros['vencimento_fim'] ?? '' }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="somente_atrasadas" name="somente_atrasadas" value="1" @checked(($filtros['somente_atrasadas'] ?? false))>
                    <label class="form-check-label" for="somente_atrasadas">Somente atrasadas</label>
                </div>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button class="btn btn-primary w-100">OK</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Cliente</th>
                    <th>Vencimento</th>
                    <th>Original</th>
                    <th>Aberto</th>
                    <th>Status</th>
                    <th style="width: 360px">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contas as $conta)
                    <tr>
                        <td>{{ $conta->documento->numero ?? ('#'.$conta->id) }}</td>
                        <td>{{ $conta->cliente->nome }}</td>
                        <td>{{ optional($conta->vencimento)->format('d/m/Y') }}</td>
                        <td>R$ {{ number_format((float) $conta->valor_original, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format((float) $conta->valor_aberto, 2, ',', '.') }}</td>
                        <td><span class="badge bg-label-{{ $conta->status === 'QUITADO' ? 'success' : ($conta->status === 'CANCELADO' ? 'secondary' : 'warning') }}">{{ $conta->status }}</span></td>
                        <td>
                            <a href="{{ route('contas-receber.show', $conta) }}" class="btn btn-sm btn-outline-primary mb-2">Ver</a>
                            @perm('financeiro.contas_receber.baixar')
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <form method="POST" action="{{ route('contas-receber.baixar', $conta) }}" class="d-flex gap-1">
                                        @csrf
                                        <input type="hidden" name="data_movimento" value="{{ now()->format('Y-m-d H:i:s') }}">
                                        <input type="number" name="valor" step="0.01" min="0.01" class="form-control form-control-sm" style="width: 90px" placeholder="Valor">
                                        <select name="forma_pagamento" class="form-select form-select-sm" style="width: 120px">
                                            <option value="">Forma</option>
                                            @foreach (['DINHEIRO','PIX','CARTAO','BOLETO','TRANSFERENCIA'] as $forma)
                                                <option value="{{ $forma }}">{{ $forma }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-outline-success" @disabled($conta->status === 'QUITADO' || $conta->status === 'CANCELADO')>Baixar</button>
                                    </form>
                                </div>
                            @endperm
                            @perm('financeiro.contas_receber.estornar')
                                <div>
                                    <form method="POST" action="{{ route('contas-receber.estornar', $conta) }}" class="d-flex gap-1">
                                        @csrf
                                        <input type="hidden" name="data_movimento" value="{{ now()->format('Y-m-d H:i:s') }}">
                                        <input type="number" name="valor" step="0.01" min="0.01" class="form-control form-control-sm" style="width: 90px" placeholder="Valor">
                                        <input type="text" name="observacao" class="form-control form-control-sm" placeholder="Motivo do estorno">
                                        <button class="btn btn-sm btn-outline-danger">Estornar</button>
                                    </form>
                                </div>
                            @endperm
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">Nenhuma conta a receber encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($contas->hasPages())
        <div class="card-footer">{{ $contas->links() }}</div>
    @endif
</div>
@endsection
