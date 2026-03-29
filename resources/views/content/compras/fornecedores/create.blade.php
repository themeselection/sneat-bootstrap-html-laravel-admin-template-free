@extends('layouts/contentNavbarLayout')

@section('title', 'Novo Fornecedor')

@section('content')
<h4 class="mb-4">Novo Fornecedor</h4>
<form method="POST" action="{{ route('fornecedores.store') }}">
    @csrf
    @include('content.compras.fornecedores._form')
</form>
@endsection
