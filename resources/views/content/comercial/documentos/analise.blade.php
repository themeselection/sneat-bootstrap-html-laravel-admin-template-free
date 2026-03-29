@extends('layouts/contentNavbarLayout')

@section('title', 'Analise da Venda')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Analise Comercial - {{ $documento->numero }}</h4>
        <p class="mb-0 text-muted">Comparativo custo de referencia vs venda com efeitos de desconto/acrescimo/imposto.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('documentos-comerciais.analise.export-csv', $documento) }}" class="btn btn-outline-primary">Exportar CSV</a>
        <a href="{{ route('documentos-comerciais.show', $documento) }}" class="btn btn-outline-secondary">Voltar</a>
    </div>
</div>

<div class="row g-4 mb-6">
    <div class="col-md-3"><div class="card border-start border-primary border-3"><div class="card-body"><small class="text-muted">Subtotal Itens</small><h5>R$ {{ number_format((float) $analise['subtotal_itens'], 2, ',', '.') }}</h5></div></div></div>
    <div class="col-md-3"><div class="card border-start border-warning border-3"><div class="card-body"><small class="text-muted">Desconto Cabecalho</small><h5>R$ {{ number_format((float) $analise['desconto_rateado_total'], 2, ',', '.') }}</h5></div></div></div>
    <div class="col-md-3"><div class="card border-start border-info border-3"><div class="card-body"><small class="text-muted">Acrescimo + Imposto</small><h5>R$ {{ number_format((float) ($analise['acrescimo_rateado_total'] + $analise['imposto_rateado_total']), 2, ',', '.') }}</h5></div></div></div>
    <div class="col-md-3"><div class="card border-start border-success border-3"><div class="card-body"><small class="text-muted">Margem Total</small><h5>R$ {{ number_format((float) $analise['total_margem'], 2, ',', '.') }} <small>({{ number_format((float) $analise['margem_percentual_total'], 2, ',', '.') }}%)</small></h5></div></div></div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qtd</th>
                    <th>Receita Bruta</th>
                    <th>Desc. Rateado</th>
                    <th>Acr. Rateado</th>
                    <th>Imp. Rateado</th>
                    <th>Custo Ref Unit.</th>
                    <th>Custo Total</th>
                    <th>Receita Liquida</th>
                    <th>Margem</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($analise['itens'] as $row)
                    <tr>
                        <td>{{ $row['item']->descricao }}</td>
                        <td>{{ number_format((float) $row['item']->quantidade, 3, ',', '.') }}</td>
                        <td>R$ {{ number_format((float) $row['receita_bruta'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format((float) $row['desconto_rateado'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format((float) $row['acrescimo_rateado'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format((float) $row['imposto_rateado'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format((float) $row['custo_ref_unitario'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format((float) $row['custo_total'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format((float) $row['receita'], 2, ',', '.') }}</td>
                        <td class="fw-semibold {{ $row['margem'] < 0 ? 'text-danger' : 'text-success' }}">R$ {{ number_format((float) $row['margem'], 2, ',', '.') }} <small>({{ number_format((float) $row['margem_percentual'], 2, ',', '.') }}%)</small></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
