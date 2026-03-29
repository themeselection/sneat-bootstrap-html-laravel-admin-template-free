@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Unidade de Medida')

@section('content')
<h4 class="mb-6">Editar Unidade de Medida</h4>
<form method="POST" action="{{ route('unidades-medida.update', $unidadeMedida) }}">
    @csrf
    @method('PUT')
    @include('content.cadastros.unidades._form')
</form>
@endsection
