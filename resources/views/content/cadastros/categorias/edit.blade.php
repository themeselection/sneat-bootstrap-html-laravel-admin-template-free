@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Categoria')

@section('content')
<h4 class="mb-6">Editar Categoria</h4>
<form method="POST" action="{{ route('categorias-produto.update', $categoriaProduto) }}">
    @csrf
    @method('PUT')
    @include('content.cadastros.categorias._form')
</form>
@endsection
