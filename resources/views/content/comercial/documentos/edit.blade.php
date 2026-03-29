@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Documento')

@section('page-script')
@vite(['resources/assets/js/documentos-form.js'])
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Editar {{ $documento->numero }}</h4>
        <p class="mb-0 text-muted">Atualize itens e valores do cabecalho conforme a etapa comercial.</p>
    </div>
</div>

<form method="POST" action="{{ route('documentos-comerciais.update', $documento) }}" id="documento-form">
    @csrf
    @method('PUT')
    @include('content.comercial.documentos._form')
</form>
@endsection
