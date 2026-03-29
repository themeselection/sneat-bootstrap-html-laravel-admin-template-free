@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Cliente')

@section('page-script')
@vite(['resources/assets/js/clientes-form.js'])
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Editar Cliente</h4>
        <p class="mb-0 text-muted">Atualize os dados cadastrais.</p>
    </div>
</div>

<form method="POST" action="{{ route('clientes.update', $cliente) }}" id="cliente-form">
    @csrf
    @method('PUT')
    @include('content.clientes._form')
</form>
@endsection
