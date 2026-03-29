@extends('layouts/contentNavbarLayout')

@section('title', 'Nova Unidade de Medida')

@section('content')
<h4 class="mb-6">Nova Unidade de Medida</h4>
<form method="POST" action="{{ route('unidades-medida.store') }}">
    @csrf
    @include('content.cadastros.unidades._form')
</form>
@endsection
