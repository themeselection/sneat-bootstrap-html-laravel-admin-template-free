@extends('layouts/contentNavbarLayout')

@section('title', 'Nova Compra')

@section('page-script')
@vite(['resources/assets/js/compra-form.js'])
@endsection

@section('content')
<h4 class="mb-4">Nova Compra</h4>

@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('compras.store') }}" id="compra-form">
    @csrf
    @include('content.compras.compras._form')
</form>
@endsection
