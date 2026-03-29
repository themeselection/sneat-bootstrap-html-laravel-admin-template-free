@extends('layouts/contentNavbarLayout')

@section('title', $documento->numero)

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-6 gap-2">
    <div>
        <h4 class="mb-1">{{ $documento->numero }}</h4>
        <p class="mb-0 text-muted">{{ $documento->tipo }} • {{ $documento->status }}</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('documentos-comerciais.analise', $documento) }}" class="btn btn-outline-info">Analise</a>
        @perm('vendas.documentos.converter')
            @if (($acoesFluxo['converter_pedido']['permitido'] ?? false) === true)
                <form method="POST" action="{{ route('documentos-comerciais.converter-pedido', $documento) }}">
                    @csrf
                    <button class="btn btn-warning">Converter em Pedido</button>
                </form>
            @else
                <button class="btn btn-outline-warning" type="button" disabled title="{{ $acoesFluxo['converter_pedido']['motivo'] ?? '' }}">Converter em Pedido</button>
            @endif
        @endif
        @perm('vendas.documentos.converter')
            @if (($acoesFluxo['converter_venda']['permitido'] ?? false) === true)
                <form method="POST" action="{{ route('documentos-comerciais.converter-venda', $documento) }}">
                    @csrf
                    <button class="btn btn-primary">Converter em Venda</button>
                </form>
            @else
                <button class="btn btn-outline-primary" type="button" disabled title="{{ $acoesFluxo['converter_venda']['motivo'] ?? '' }}">Converter em Venda</button>
            @endif
        @endif
        @perm('vendas.documentos.faturar')
            @if (($acoesFluxo['faturar']['permitido'] ?? false) === true)
                <form method="POST" action="{{ route('documentos-comerciais.faturar', $documento) }}" onsubmit="return confirm('Confirmar faturamento?')">
                    @csrf
                    <button class="btn btn-success">Faturar</button>
                </form>
            @else
                <button class="btn btn-outline-success" type="button" disabled title="{{ $acoesFluxo['faturar']['motivo'] ?? '' }}">Faturar</button>
            @endif
        @endif
        @perm('vendas.documentos.cancelar')
            @if (($podeGerenciarCancelamento ?? false) && !in_array($documento->status, ['FATURADO', 'CANCELADO']))
                <form method="POST" action="{{ route('documentos-comerciais.destroy', $documento) }}" onsubmit="return confirmCancelamento(this)">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="motivo_cancelamento" value="">
                    <button class="btn btn-outline-danger">Cancelar Documento</button>
                </form>
            @endif
            @if (($podeGerenciarCancelamento ?? false) && $documento->status === 'CANCELADO')
                <form method="POST" action="{{ route('documentos-comerciais.reabrir', $documento) }}" onsubmit="return confirmReabertura(this)">
                    @csrf
                    <input type="hidden" name="motivo_reabertura" value="">
                    <button class="btn btn-outline-success">Reabrir Documento</button>
                </form>
            @endif
        @endif
        @perm('vendas.documentos.manage')
            @if (($regrasEdicao['pode_editar'] ?? false) === true)
                <a href="{{ route('documentos-comerciais.edit', $documento) }}" class="btn btn-outline-primary">Editar</a>
            @endif
        @endperm
        <a href="{{ route('documentos-comerciais.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
@if (($regrasEdicao['pode_editar'] ?? true) === false)
    <div class="alert alert-warning">{{ $regrasEdicao['motivo'] ?? 'Documento em modo somente leitura.' }}</div>
@endif
@if (($podeGerenciarCancelamento ?? false) === false)
    <div class="alert alert-info">Cancelamento/Reabertura disponivel apenas para usuarios autorizados.</div>
@endif

<div class="row g-6">
    <div class="col-lg-8">
        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Itens</h5></div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th>Qtd</th>
                            <th>Preco Unit.</th>
                            <th>Subtotal</th>
                            <th>Reserva</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documento->itens as $item)
                            <tr>
                                <td>{{ $item->sequencia }}</td>
                                <td>{{ $item->descricao }}</td>
                                <td>{{ number_format((float) $item->quantidade, 3, ',', '.') }} {{ $item->unidade_sigla }}</td>
                                <td>R$ {{ number_format((float) $item->preco_unitario, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format((float) $item->subtotal_liquido, 2, ',', '.') }}</td>
                                <td>
                                    @if ($item->reserva)
                                        <span class="badge bg-label-{{ $item->reserva->status === 'ATIVA' ? 'warning' : ($item->reserva->status === 'CONSUMIDA' ? 'success' : 'secondary') }}">{{ $item->reserva->status }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Eventos do Fluxo</h5></div>
            <div class="card-body">
                <ul class="timeline mb-0">
                    @foreach ($documento->eventos as $evento)
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <h6 class="mb-0">{{ $evento->acao }}</h6>
                                    <small class="text-muted">{{ optional($evento->data_evento)->format('d/m/Y H:i') }}</small>
                                </div>
                                <p class="mb-0 text-muted">{{ $evento->status_anterior ?: '-' }} -> {{ $evento->status_novo }}</p>
                                <small class="text-muted">Usuario: {{ $evento->usuario?->name ?? 'Sistema' }}</small>
                                @if (!empty($evento->detalhes['motivo_cancelamento']))
                                    <div class="small text-danger mt-1">Motivo: {{ $evento->detalhes['motivo_cancelamento'] }}</div>
                                @endif
                                @if (!empty($evento->detalhes['motivo_reabertura']))
                                    <div class="small text-success mt-1">Motivo reabertura: {{ $evento->detalhes['motivo_reabertura'] }}</div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Resumo</h5></div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2"><span>Cliente</span><strong>{{ $documento->cliente->nome }}</strong></div>
                <div class="d-flex justify-content-between mb-2"><span>Vendedor</span><strong>{{ $documento->vendedor->name }}</strong></div>
                <div class="d-flex justify-content-between mb-2"><span>Subtotal</span><strong>R$ {{ number_format((float) $documento->subtotal, 2, ',', '.') }}</strong></div>
                <div class="d-flex justify-content-between mb-2"><span>Desconto</span><strong>R$ {{ number_format((float) $documento->desconto_total, 2, ',', '.') }}</strong></div>
                <div class="d-flex justify-content-between mb-2"><span>Acrescimo</span><strong>R$ {{ number_format((float) $documento->acrescimo_total, 2, ',', '.') }}</strong></div>
                <div class="d-flex justify-content-between mb-2"><span>Impostos</span><strong>R$ {{ number_format((float) $documento->impostos_total, 2, ',', '.') }}</strong></div>
                <hr>
                <div class="d-flex justify-content-between"><span>Total</span><strong>R$ {{ number_format((float) $documento->total_liquido, 2, ',', '.') }}</strong></div>
                @if ($documento->faturamento)
                    <hr>
                    <div class="small text-muted">NF: {{ $documento->faturamento->numero_fiscal }}</div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h5 class="mb-0">Indicadores Rapidos</h5></div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2"><span>Receita</span><strong>R$ {{ number_format((float) $analise['total_receita'], 2, ',', '.') }}</strong></div>
                <div class="d-flex justify-content-between mb-2"><span>Custo Referencia</span><strong>R$ {{ number_format((float) $analise['total_custo_ref'], 2, ',', '.') }}</strong></div>
                <div class="d-flex justify-content-between"><span>Margem</span><strong>R$ {{ number_format((float) $analise['total_margem'], 2, ',', '.') }}</strong></div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmCancelamento(form) {
    const motivo = prompt('Informe o motivo do cancelamento:');
    if (!motivo || motivo.trim().length < 5) {
        alert('Informe um motivo com pelo menos 5 caracteres.');
        return false;
    }

    form.querySelector('input[name="motivo_cancelamento"]').value = motivo.trim();
    return confirm('Confirmar cancelamento do documento?');
}

function confirmReabertura(form) {
    const motivo = prompt('Informe o motivo da reabertura:');
    if (!motivo || motivo.trim().length < 5) {
        alert('Informe um motivo com pelo menos 5 caracteres.');
        return false;
    }

    form.querySelector('input[name="motivo_reabertura"]').value = motivo.trim();
    return confirm('Confirmar reabertura do documento?');
}
</script>
@endsection
