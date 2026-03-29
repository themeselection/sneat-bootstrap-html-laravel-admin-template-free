@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Produto')

@section('page-script')
@vite(['resources/assets/js/produtos-form.js'])
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Editar Produto</h4>
        <p class="mb-0 text-muted">Atualize dados cadastrais, regras e tabela de preco.</p>
    </div>
</div>

<form method="POST" action="{{ route('produtos.update', $produto) }}" id="produto-form">
    @csrf
    @method('PUT')
    @include('content.produtos._form')
</form>
@endsection
