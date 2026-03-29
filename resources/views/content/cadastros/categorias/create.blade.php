@extends('layouts/contentNavbarLayout')

@section('title', 'Nova Categoria')

@section('content')
<h4 class="mb-6">Nova Categoria</h4>
<form method="POST" action="{{ route('categorias-produto.store') }}">
    @csrf
    @include('content.cadastros.categorias._form')
</form>
@endsection
