@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Fornecedor')

@section('content')
<h4 class="mb-4">Editar Fornecedor</h4>
<form method="POST" action="{{ route('fornecedores.update', $fornecedor) }}">
    @csrf
    @method('PUT')
    @include('content.compras.fornecedores._form')
</form>
@endsection
