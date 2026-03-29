@extends('layouts/contentNavbarLayout')

@section('title', 'Novo Documento')

@section('page-script')
@vite(['resources/assets/js/documentos-form.js'])
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Novo Documento Comercial</h4>
        <p class="mb-0 text-muted">Fluxo unificado: Orcamento -> Prevenda -> Pedido -> Venda -> Faturamento.</p>
    </div>
</div>

<form method="POST" action="{{ route('documentos-comerciais.store') }}" id="documento-form">
    @csrf
    @include('content.comercial.documentos._form')
</form>
@endsection
