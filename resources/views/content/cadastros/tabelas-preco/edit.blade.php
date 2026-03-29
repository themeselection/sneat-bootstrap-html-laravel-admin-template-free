@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Tabela de Preco')

@section('content')
<h4 class="mb-6">Editar Tabela de Preco</h4>
<form method="POST" action="{{ route('tabelas-preco.update', $tabelaPreco) }}">
    @csrf
    @method('PUT')
    @include('content.cadastros.tabelas-preco._form')
</form>
@endsection
