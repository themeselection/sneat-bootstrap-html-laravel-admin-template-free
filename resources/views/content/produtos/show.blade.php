@extends('layouts/contentNavbarLayout')

@section('title', 'Detalhes do Produto')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-6 gap-3">
    <div>
        <h4 class="mb-1">{{ $produto->nome }}</h4>
        <p class="mb-0 text-muted">SKU: {{ $produto->sku }}</p>
    </div>
    <div class="d-flex gap-2">
        @perm('produtos.manage')
            <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-primary">Editar</a>
        @endperm
        <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@php
    $saldo = $produto->estoqueSaldo;
@endphp

<div class="row g-6">
    <div class="col-lg-8">
        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Dados do Produto</h5></div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-3"><strong>SKU</strong><br>{{ $produto->sku }}</div>
                    <div class="col-md-5"><strong>Nome</strong><br>{{ $produto->nome }}</div>
                    <div class="col-md-4"><strong>Codigo de Barras</strong><br>{{ $produto->codigo_barras ?: '-' }}</div>
                    <div class="col-md-4"><strong>Categoria</strong><br>{{ $produto->categoria->nome }}</div>
                    <div class="col-md-4"><strong>Unidade</strong><br>{{ $produto->unidadePrincipal->sigla }} - {{ $produto->unidadePrincipal->nome }}</div>
                    <div class="col-md-4"><strong>Marca</strong><br>{{ $produto->marca ?: '-' }}</div>
                    <div class="col-md-4"><strong>NCM</strong><br>{{ $produto->ncm ?: '-' }}</div>
                    <div class="col-md-4"><strong>CEST</strong><br>{{ $produto->cest ?: '-' }}</div>
                    <div class="col-md-4"><strong>Status</strong><br>{{ $produto->ativo ? 'Ativo' : 'Inativo' }}</div>
                    <div class="col-12"><strong>Descricao</strong><br>{{ $produto->descricao ?: '-' }}</div>
                    <div class="col-12"><strong>Observacoes</strong><br>{{ $produto->observacoes ?: '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Estoque</h5></div>
            <div class="card-body">
                <p><strong>Quantidade atual:</strong><br>{{ number_format((float) ($saldo->quantidade_atual ?? 0), 3, ',', '.') }}</p>
                <p><strong>Estoque minimo:</strong><br>{{ number_format((float) ($saldo->estoque_minimo ?? 0), 3, ',', '.') }}</p>
                <p>
                    <strong>Situacao:</strong><br>
                    @if ((float) ($saldo->quantidade_atual ?? 0) <= (float) ($saldo->estoque_minimo ?? 0))
                        <span class="badge bg-label-warning">Baixo estoque</span>
                    @else
                        <span class="badge bg-label-success">Normal</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h5 class="mb-0">Tabelas de Preco</h5></div>
            <div class="card-body">
                @forelse ($produto->precos->where('ativo', true) as $preco)
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="fw-semibold">{{ $preco->tabelaPreco->nome }}</div>
                        <div>Preco: R$ {{ number_format((float) $preco->preco, 2, ',', '.') }}</div>
                        <small class="text-muted">
                            Custo: R$ {{ number_format((float) ($preco->custo_referencia ?? 0), 2, ',', '.') }}
                            @if ($preco->margem_percentual !== null)
                                | Margem: {{ number_format((float) $preco->margem_percentual, 2, ',', '.') }}%
                            @endif
                        </small>
                    </div>
                @empty
                    <p class="text-muted mb-0">Sem preco ativo cadastrado.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
