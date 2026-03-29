@extends('layouts/contentNavbarLayout')

@section('title', 'Alertas de Estoque')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Alertas de Estoque</h4>
        <p class="mb-0 text-muted">Visão de ruptura e baixo estoque por produto. Filial referência: {{ $filialReferencia }} (estoque global).</p>
    </div>
    @perm('estoque.movimentacoes.manage')
        <a href="{{ route('movimentacoes-estoque.create') }}" class="btn btn-primary">Registrar Movimentação</a>
    @endperm
</div>

<div class="row g-4 mb-6">
    <div class="col-md-4"><div class="card border-start border-info border-3"><div class="card-body"><small class="text-muted">Itens monitorados</small><h4 class="mb-0">{{ number_format($cards['itens_monitorados'], 0, ',', '.') }}</h4></div></div></div>
    <div class="col-md-4"><div class="card border-start border-warning border-3"><div class="card-body"><small class="text-muted">Baixo estoque</small><h4 class="mb-0">{{ number_format($cards['baixo_estoque'], 0, ',', '.') }}</h4></div></div></div>
    <div class="col-md-4"><div class="card border-start border-danger border-3"><div class="card-body"><small class="text-muted">Ruptura</small><h4 class="mb-0">{{ number_format($cards['ruptura'], 0, ',', '.') }}</h4></div></div></div>
</div>

<div class="card mb-6">
    <div class="card-body">
        <form method="GET" action="{{ route('estoque.alertas.index') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Busca</label>
                <input type="text" name="busca" class="form-control" value="{{ $filtros['busca'] ?? '' }}" placeholder="Produto, SKU ou código de barras">
            </div>
            <div class="col-md-3">
                <label class="form-label">Categoria</label>
                <select name="categoria_id" class="form-select">
                    <option value="">Todas</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected((string) ($filtros['categoria_id'] ?? '') === (string) $categoria->id)>{{ $categoria->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tipo de Alerta</label>
                <select name="tipo_alerta" class="form-select">
                    <option value="" @selected(($filtros['tipo_alerta'] ?? '') === '')>Todos</option>
                    <option value="BAIXO" @selected(($filtros['tipo_alerta'] ?? '') === 'BAIXO')>Somente baixo estoque</option>
                    <option value="RUPTURA" @selected(($filtros['tipo_alerta'] ?? '') === 'RUPTURA')>Somente ruptura</option>
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
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Atual</th>
                    <th>Reservado</th>
                    <th>Disponível</th>
                    <th>Mínimo</th>
                    <th>Alerta</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($saldos as $saldo)
                    @php
                        $atual = (float) $saldo->quantidade_atual;
                        $reservado = (float) $saldo->quantidade_reservada;
                        $disponivel = $atual - $reservado;
                        $minimo = (float) $saldo->estoque_minimo;
                        $ruptura = $atual <= 0;
                        $baixo = !$ruptura && $atual <= $minimo;
                    @endphp
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $saldo->produto->nome }}</div>
                            <small class="text-muted">{{ $saldo->produto->sku }} • {{ $saldo->produto->codigo_barras ?: '-' }}</small>
                        </td>
                        <td>{{ $saldo->produto->categoria->nome ?? '-' }}</td>
                        <td>{{ number_format($atual, 3, ',', '.') }}</td>
                        <td>{{ number_format($reservado, 3, ',', '.') }}</td>
                        <td>{{ number_format($disponivel, 3, ',', '.') }}</td>
                        <td>{{ number_format($minimo, 3, ',', '.') }}</td>
                        <td>
                            @if ($ruptura)
                                <span class="badge bg-label-danger">RUPTURA</span>
                            @elseif ($baixo)
                                <span class="badge bg-label-warning">BAIXO ESTOQUE</span>
                            @else
                                <span class="badge bg-label-success">OK</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">Nenhum alerta encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($saldos->hasPages())
        <div class="card-footer">{{ $saldos->links() }}</div>
    @endif
</div>
@endsection
