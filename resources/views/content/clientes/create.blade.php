@extends('layouts/contentNavbarLayout')

@section('title', 'Novo Cliente')

@section('page-script')
@vite(['resources/assets/js/clientes-form.js'])
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Novo Cliente</h4>
        <p class="mb-0 text-muted">Cadastre cliente pessoa fisica ou juridica.</p>
    </div>
</div>

<form method="POST" action="{{ route('clientes.store') }}" id="cliente-form">
    @csrf
    @include('content.clientes._form')
</form>
@endsection
