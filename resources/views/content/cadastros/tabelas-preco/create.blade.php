@extends('layouts/contentNavbarLayout')

@section('title', 'Nova Tabela de Preco')

@section('content')
<h4 class="mb-6">Nova Tabela de Preco</h4>
<form method="POST" action="{{ route('tabelas-preco.store') }}">
    @csrf
    @include('content.cadastros.tabelas-preco._form')
</form>
@endsection
