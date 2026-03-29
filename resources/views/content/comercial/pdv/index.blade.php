@extends('layouts/contentNavbarLayout')

@section('title', 'PDV Rapido')

@section('page-script')
@vite(['resources/assets/js/pdv.js'])
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Frente de Caixa (PDV)</h4>
        <p class="mb-0 text-muted">Busca rapida por nome/EAN, carrinho dinamico e fechamento em um clique.</p>
    </div>
    <a href="{{ route('documentos-comerciais.index') }}" class="btn btn-outline-secondary">Voltar para vendas</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Não foi possível concluir a venda.</strong>
        <div class="mt-1">{{ $errors->first() }}</div>
    </div>
@endif

<form method="POST" action="{{ route('pdv.finalizar') }}" id="pdv-form">
    @csrf
    <input type="hidden" name="tipo" value="VENDA">
    <input type="hidden" name="status" value="AGUARDANDO_FATURAMENTO">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="input-group mb-2 position-relative">
                        <span class="input-group-text"><i class="icon-base bx bx-search"></i></span>
                        <input type="text" id="pdv-search" class="form-control" placeholder="Digite nome, SKU ou EAN e pressione Enter para adicionar">
                        <div id="pdv-search-results" class="list-group position-absolute w-100 shadow-sm" style="z-index: 20; top: 44px; display: none; max-height: 320px; overflow-y: auto;"></div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-label-primary">Itens: <strong id="pdv-total-itens">0</strong></span>
                        <span class="badge bg-label-info">Volume: <strong id="pdv-total-volume">0,000</strong></span>
                        <span class="badge bg-label-secondary">Atalhos: `F2` busca, `F4` finalizar, `F8` limpar</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="pdv-carrinho">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th style="width: 110px">Qtd</th>
                                    <th style="width: 140px">Preco</th>
                                    <th style="width: 140px">Subtotal</th>
                                    <th style="width: 70px"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <label class="form-label" for="cliente_id">Cliente *</label>
                    <select name="cliente_id" id="cliente_id" class="form-select mb-3" required>
                        <option value="">Selecione</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }} ({{ $cliente->cpf_cnpj }})</option>
                        @endforeach
                    </select>

                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label">Desconto</label>
                            <input type="number" step="0.01" min="0" name="desconto_total" id="pdv-desconto" class="form-control" value="0">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Acrescimo</label>
                            <input type="number" step="0.01" min="0" name="acrescimo_total" id="pdv-acrescimo" class="form-control" value="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Impostos</label>
                            <input type="number" step="0.01" min="0" name="impostos_total" id="pdv-impostos" class="form-control" value="0">
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between mb-2"><span>Subtotal</span><strong id="pdv-subtotal">R$ 0,00</strong></div>
                    <div class="d-flex justify-content-between mb-2"><span>Total</span><strong id="pdv-total">R$ 0,00</strong></div>
                    <button type="button" class="btn btn-outline-danger w-100 mt-2" id="pdv-clear-cart">Limpar Carrinho (F8)</button>
                    <button type="submit" class="btn btn-success w-100 mt-3">Finalizar Venda</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
@php
    $pdvProdutosPayload = $produtos->map(function ($p) use ($precos) {
        return [
            'id' => $p->id,
            'nome' => $p->nome,
            'sku' => $p->sku,
            'ean' => $p->codigo_barras,
            'unidade' => $p->unidadePrincipal?->sigla ?? 'UN',
            'estoque' => (float) ($p->estoqueSaldo->quantidade_atual ?? 0),
            'preco' => (float) ($precos[$p->id]->preco ?? 0),
        ];
    })->values();
@endphp
window.pdvProdutos = @json($pdvProdutosPayload);
</script>
@endsection
