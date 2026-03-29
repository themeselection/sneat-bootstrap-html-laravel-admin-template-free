@extends('layouts/contentNavbarLayout')

@section('title', 'Matriz de Permissoes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Matriz de Permissoes</h4>
        <p class="mb-0 text-muted">Visao central das permissoes por nivel de acesso.</p>
    </div>
    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Voltar</a>
</div>

<div class="row g-4">
    @foreach ($matriz as $nivel => $permissoes)
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">{{ $nivel }}</h5>
                </div>
                <div class="card-body">
                    @if (in_array('*', $permissoes, true))
                        <span class="badge bg-label-success">Acesso total</span>
                    @else
                        <ul class="mb-0 ps-3">
                            @foreach ($permissoes as $permissao)
                                <li><code>{{ $permissao }}</code></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

