@extends('layouts/contentNavbarLayout')

@section('title', 'Detalhes do Cliente')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-6">
    <div>
        <h4 class="mb-1">Cliente: {{ $cliente->nome }}</h4>
        <p class="mb-0 text-muted">{{ $cliente->tipo_pessoa === 'PJ' ? 'Pessoa Juridica' : 'Pessoa Fisica' }}</p>
    </div>
    <div class="d-flex gap-2">
        @perm('clientes.manage')
            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-primary">Editar</a>
        @endperm
        <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-6">
    <div class="col-lg-8">
        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Dados Cadastrais</h5></div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-3"><strong>Codigo:</strong><br>{{ $cliente->codigo ?: '-' }}</div>
                    <div class="col-md-3"><strong>Tipo:</strong><br>{{ $cliente->tipo_pessoa }}</div>
                    <div class="col-md-6"><strong>Nome:</strong><br>{{ $cliente->nome }}</div>
                    <div class="col-md-6"><strong>{{ $cliente->tipo_pessoa === 'PJ' ? 'CNPJ' : 'CPF' }}:</strong><br>{{ $cliente->documento_formatado }}</div>
                    <div class="col-md-6"><strong>{{ $cliente->tipo_pessoa === 'PJ' ? 'IE' : 'RG' }}:</strong><br>{{ $cliente->rg_ie ?: '-' }}</div>
                    <div class="col-md-6"><strong>Nome Fantasia:</strong><br>{{ $cliente->nome_fantasia ?: '-' }}</div>
                    <div class="col-md-6"><strong>Data:</strong><br>{{ optional($cliente->data_nascimento_fundacao)->format('d/m/Y') ?: '-' }}</div>
                    <div class="col-md-6"><strong>Sexo:</strong><br>{{ $cliente->sexo ?: '-' }}</div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Endereco</h5></div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-2"><strong>CEP:</strong><br>{{ $cliente->cep ?: '-' }}</div>
                    <div class="col-md-8"><strong>Logradouro:</strong><br>{{ $cliente->logradouro ?: '-' }}</div>
                    <div class="col-md-2"><strong>Numero:</strong><br>{{ $cliente->numero ?: '-' }}</div>
                    <div class="col-md-4"><strong>Complemento:</strong><br>{{ $cliente->complemento ?: '-' }}</div>
                    <div class="col-md-4"><strong>Bairro:</strong><br>{{ $cliente->bairro ?: '-' }}</div>
                    <div class="col-md-4"><strong>Cidade/UF:</strong><br>{{ $cliente->cidade ?: '-' }}{{ $cliente->uf ? '/'.$cliente->uf : '' }}</div>
                    <div class="col-md-6"><strong>Pais:</strong><br>{{ $cliente->pais }}</div>
                    <div class="col-md-6"><strong>Cod. IBGE:</strong><br>{{ $cliente->codigo_ibge ?: '-' }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Contato</h5></div>
            <div class="card-body">
                <p><strong>Email:</strong><br>{{ $cliente->email ?: '-' }}</p>
                <p><strong>Telefone:</strong><br>{{ $cliente->telefone ?: '-' }}</p>
                <p><strong>Celular:</strong><br>{{ $cliente->celular ?: '-' }}</p>
                <p><strong>Contato:</strong><br>{{ $cliente->contato_nome ?: '-' }}</p>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Financeiro</h5></div>
            <div class="card-body">
                <p><strong>Saldo Credito:</strong><br>R$ {{ number_format((float) $cliente->saldo_credito, 2, ',', '.') }}</p>
                <p><strong>Limite a Prazo:</strong><br>R$ {{ number_format((float) $cliente->limite_prazo, 2, ',', '.') }}</p>
                <p><strong>Situacao:</strong><br>
                    <span class="badge bg-label-{{ $cliente->ativo ? 'success' : 'secondary' }}">{{ $cliente->ativo ? 'Ativo' : 'Inativo' }}</span>
                </p>
            </div>
        </div>
        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Resumo Comercial</h5></div>
            <div class="card-body">
                <p><strong>Documentos:</strong><br>{{ number_format((int) ($resumoComercial['documentos_total'] ?? 0), 0, ',', '.') }}</p>
                <p><strong>Vendas Faturadas:</strong><br>{{ number_format((int) ($resumoComercial['vendas_faturadas'] ?? 0), 0, ',', '.') }}</p>
                <p><strong>Ultima Venda:</strong><br>{{ !empty($resumoComercial['ultima_venda']) ? \Illuminate\Support\Carbon::parse($resumoComercial['ultima_venda'])->format('d/m/Y H:i') : '-' }}</p>
                <p class="mb-0"><strong>Contas em Aberto:</strong><br>R$ {{ number_format((float) ($resumoComercial['receber_em_aberto'] ?? 0), 2, ',', '.') }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Observacoes</h5></div>
            <div class="card-body">
                <p class="mb-0">{{ $cliente->observacoes ?: '-' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
