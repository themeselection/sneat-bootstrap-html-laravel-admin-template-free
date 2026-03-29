@extends('layouts/contentNavbarLayout')

@section('title', 'Detalhe da Conta a Receber')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Conta #{{ $conta->id }}</h4>
        <p class="mb-0 text-muted">Documento: {{ $conta->documento->numero ?? '-' }} • Status: {{ $conta->status }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('contas-receber.extrato.export-csv', $conta) }}" class="btn btn-outline-primary">Exportar Extrato CSV</a>
        <a href="{{ route('contas-receber.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>
</div>

<div class="row g-6">
    <div class="col-lg-4">
        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Resumo</h5></div>
            <div class="card-body">
                <p class="mb-2"><strong>Cliente:</strong><br>{{ $conta->cliente->nome ?? '-' }}</p>
                <p class="mb-2"><strong>Vencimento:</strong><br>{{ optional($conta->vencimento)->format('d/m/Y') ?: '-' }}</p>
                <p class="mb-2"><strong>Valor Original:</strong><br>R$ {{ number_format((float) $conta->valor_original, 2, ',', '.') }}</p>
                <p class="mb-2"><strong>Valor Aberto:</strong><br>R$ {{ number_format((float) $conta->valor_aberto, 2, ',', '.') }}</p>
                <p class="mb-0"><strong>Status:</strong><br><span class="badge bg-label-{{ $conta->status === 'QUITADO' ? 'success' : ($conta->status === 'CANCELADO' ? 'secondary' : 'warning') }}">{{ $conta->status }}</span></p>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Movimentações</h5></div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Forma</th>
                            <th>Usuário</th>
                            <th>Observação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($conta->movimentos->sortByDesc('data_movimento') as $mov)
                            <tr>
                                <td>{{ optional($mov->data_movimento)->format('d/m/Y H:i') }}</td>
                                <td><span class="badge bg-label-{{ $mov->tipo === 'RECEBIMENTO' ? 'success' : 'danger' }}">{{ $mov->tipo }}</span></td>
                                <td>R$ {{ number_format((float) $mov->valor, 2, ',', '.') }}</td>
                                <td>{{ $mov->forma_pagamento ?: '-' }}</td>
                                <td>{{ $mov->usuario->name ?? 'Sistema' }}</td>
                                <td>{{ $mov->observacao ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Sem movimentações para esta conta.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
