@extends('layouts/contentNavbarLayout')

@section('title', 'Novo Produto')

@section('page-script')
@vite(['resources/assets/js/produtos-form.js'])
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Novo Produto</h4>
        <p class="mb-0 text-muted">Cadastro com estrutura preparada para estoque e tabelas de preco.</p>
    </div>
</div>

<form method="POST" action="{{ route('produtos.store') }}" id="produto-form">
    @csrf
    @include('content.produtos._form')
</form>
@endsection
