@extends('layouts/contentNavbarLayout')

@section('title', $compra->numero)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">{{ $compra->numero }}</h4>
        <p class="mb-0 text-muted">{{ $compra->fornecedor->nome }} • {{ $compra->status }}</p>
    </div>
    <a href="{{ route('compras.index') }}" class="btn btn-outline-secondary">Voltar</a>
</div>

<div class="row g-4 mb-6">
    <div class="col-md-3"><div class="card border-start border-primary border-3"><div class="card-body"><small class="text-muted">Itens</small><h5 class="mb-0">{{ number_format((int) ($analitico['itens_total'] ?? 0), 0, ',', '.') }}</h5></div></div></div>
    <div class="col-md-3"><div class="card border-start border-info border-3"><div class="card-body"><small class="text-muted">Qtd Total</small><h5 class="mb-0">{{ number_format((float) ($analitico['qtd_total'] ?? 0), 3, ',', '.') }}</h5></div></div></div>
    <div class="col-md-3"><div class="card border-start border-success border-3"><div class="card-body"><small class="text-muted">Ticket Médio Item</small><h5 class="mb-0">R$ {{ number_format((float) ($analitico['ticket_medio_item'] ?? 0), 2, ',', '.') }}</h5></div></div></div>
    <div class="col-md-3"><div class="card border-start border-warning border-3"><div class="card-body"><small class="text-muted">Entradas Estoque</small><h5 class="mb-0">{{ number_format((float) ($analitico['qtd_entrada_estoque'] ?? 0), 3, ',', '.') }}</h5></div></div></div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Itens</h5></div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th>Qtd</th>
                            <th>Preço Unit.</th>
                            <th>Subtotal</th>
                            <th>Lote</th>
                            <th>Validade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compra->itens as $item)
                            <tr>
                                <td>{{ $item->sequencia }}</td>
                                <td>{{ $item->produto->nome }}</td>
                                <td>{{ number_format((float) $item->quantidade, 3, ',', '.') }}</td>
                                <td>R$ {{ number_format((float) $item->preco_unitario, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format((float) $item->subtotal, 2, ',', '.') }}</td>
                                <td>{{ $item->numero_lote ?: '-' }}</td>
                                <td>{{ optional($item->data_validade)->format('d/m/Y') ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2"><span>Fornecedor</span><strong>{{ $compra->fornecedor->nome }}</strong></div>
                <div class="d-flex justify-content-between mb-2"><span>Filial</span><strong>{{ $compra->filial->nome }}</strong></div>
                <div class="d-flex justify-content-between mb-2"><span>Data</span><strong>{{ optional($compra->data_compra)->format('d/m/Y H:i') }}</strong></div>
                <div class="d-flex justify-content-between mb-2"><span>Status</span><strong>{{ $compra->status }}</strong></div>
                <hr>
                <div class="d-flex justify-content-between mb-2"><span>Total compra</span><strong>R$ {{ number_format((float) $compra->valor_total, 2, ',', '.') }}</strong></div>
                @if ($compra->contaPagar)
                    <div class="d-flex justify-content-between mb-2"><span>Conta a pagar</span><strong>{{ $compra->contaPagar->status }}</strong></div>
                    <div class="d-flex justify-content-between mb-2"><span>Aberto</span><strong>R$ {{ number_format((float) $compra->contaPagar->valor_aberto, 2, ',', '.') }}</strong></div>
                    <div class="d-flex justify-content-between"><span>Vencimento</span><strong>{{ optional($compra->contaPagar->vencimento)->format('d/m/Y') }}</strong></div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card mt-6">
    <div class="card-header"><h5 class="mb-0">Movimentações de Estoque da Compra</h5></div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Produto</th>
                    <th>Tipo</th>
                    <th>Qtd</th>
                    <th>Saldo Após</th>
                    <th>Lote/Serial</th>
                    <th>Ref.</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($movimentacoes as $mov)
                    <tr>
                        <td>{{ optional($mov->created_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ $mov->produto->sku ?? '-' }} - {{ $mov->produto->nome ?? '-' }}</td>
                        <td>{{ $mov->tipo }}</td>
                        <td>{{ $mov->sinal > 0 ? '+' : '-' }}{{ number_format((float) $mov->quantidade, 3, ',', '.') }}</td>
                        <td>{{ number_format((float) $mov->saldo_apos, 3, ',', '.') }}</td>
                        <td>{{ $mov->lote ? $mov->lote->lote . ($mov->lote->serial ? ' / ' . $mov->lote->serial : '') : '-' }}</td>
                        <td>{{ $mov->documento_ref ?: '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Sem movimentações de estoque vinculadas a esta compra.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
