@extends('layouts/contentNavbarLayout')

@section('title', 'Produtos')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-6 gap-3">
    <div>
        <h4 class="mb-1">Produtos</h4>
        <p class="mb-0 text-muted">Cadastro, consulta e manutencao de produtos.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('produtos.export-csv', request()->query()) }}" class="btn btn-outline-primary">
            <i class="icon-base bx bx-download me-1"></i>Exportar CSV
        </a>
        @perm('estoque.alertas.view')
            <a href="{{ route('estoque.alertas.index') }}" class="btn btn-outline-warning">
                <i class="icon-base bx bx-error-circle me-1"></i>Alertas de Estoque
            </a>
        @endperm
        @perm('produtos.manage')
            <a href="{{ route('produtos.create') }}" class="btn btn-primary">
                <i class="icon-base bx bx-plus me-1"></i>Novo Produto
            </a>
        @endperm
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row g-4 mb-6">
    <div class="col-xl-2 col-md-4">
        <div class="card border-start border-primary border-3">
            <div class="card-body">
                <small class="text-muted">Total de itens</small>
                <h4 class="mb-0">{{ number_format($cards['total'], 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4">
        <div class="card border-start border-success border-3">
            <div class="card-body">
                <small class="text-muted">Ativos</small>
                <h4 class="mb-0">{{ number_format($cards['ativos'], 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4">
        <div class="card border-start border-warning border-3">
            <div class="card-body">
                <small class="text-muted">Baixo estoque</small>
                <h4 class="mb-0">{{ number_format($cards['baixo_estoque'], 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4">
        <div class="card border-start border-info border-3">
            <div class="card-body">
                <small class="text-muted">Com preco cadastrado</small>
                <h4 class="mb-0">{{ number_format($cards['com_preco'], 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4">
        <div class="card border-start border-dark border-3">
            <div class="card-body">
                <small class="text-muted">Margem média ref.</small>
                <h4 class="mb-0">{{ number_format((float) $cards['margem_media_ref'], 2, ',', '.') }}%</h4>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4">
        <div class="card border-start border-secondary border-3">
            <div class="card-body">
                <small class="text-muted">Cobertura média</small>
                <h4 class="mb-0">{{ number_format((float) $cards['cobertura_media_dias'], 1, ',', '.') }}d</h4>
            </div>
        </div>
    </div>
</div>

<div class="card mb-6">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h6 class="mb-1">Importar Produtos</h6>
                <small class="text-muted">Aceita CSV ou XLSX com colunas: <code>nome</code>, <code>ean</code>, <code>marca</code>, <code>custo</code>, <code>preco_venda</code>.</small>
            </div>
            @perm('produtos.manage')
                <a href="{{ route('produtos.importar.template') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="icon-base bx bx-download me-1"></i>Baixar Template
                </a>
            @endperm
        </div>
        @perm('produtos.manage')
            <form action="{{ route('produtos.importar') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-lg-8">
                    <label class="form-label" for="arquivo">Arquivo</label>
                    <input type="file" id="arquivo" name="arquivo" class="form-control @error('arquivo') is-invalid @enderror" accept=".csv,.txt,.xlsx" required>
                    @error('arquivo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-outline-primary w-100">Importar arquivo</button>
                </div>
            </form>
        @endperm
    </div>
</div>

<div class="card mb-6">
    <div class="card-body">
        <form method="GET" action="{{ route('produtos.index') }}" class="row g-3">
            <div class="col-lg-4">
                <label for="busca" class="form-label">Busca</label>
                <input type="text" id="busca" name="busca" class="form-control" value="{{ $filtros['busca'] ?? '' }}" placeholder="Nome, SKU ou codigo de barras">
            </div>
            <div class="col-lg-3">
                <label for="categoria_id" class="form-label">Categoria</label>
                <select id="categoria_id" name="categoria_id" class="form-select">
                    <option value="">Todas</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected((string) ($filtros['categoria_id'] ?? '') === (string) $categoria->id)>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <label for="ativo" class="form-label">Situacao</label>
                <select id="ativo" name="ativo" class="form-select">
                    <option value="">Todos</option>
                    <option value="1" @selected(($filtros['ativo'] ?? '') === '1')>Ativo</option>
                    <option value="0" @selected(($filtros['ativo'] ?? '') === '0')>Inativo</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label for="baixo_estoque" class="form-label">Estoque</label>
                <select id="baixo_estoque" name="baixo_estoque" class="form-select">
                    <option value="">Todos</option>
                    <option value="1" @selected(($filtros['baixo_estoque'] ?? '') === '1')>Somente baixo</option>
                </select>
            </div>
            <div class="col-lg-1 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">OK</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Unidade</th>
                    <th>Preco Atual</th>
                    <th>Margem Ref.</th>
                    <th>Estoque</th>
                    <th>Cobertura</th>
                    <th>Status</th>
                    <th class="text-end">Acoes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produtos as $produto)
                    @php
                        $saldo = $produto->estoqueSaldo;
                        $estoqueAtual = (float) ($saldo->quantidade_atual ?? 0);
                        $estoqueMinimo = (float) ($saldo->estoque_minimo ?? 0);
                        $baixo = $estoqueAtual <= $estoqueMinimo;
                    @endphp
                    <tr>
                        <td>{{ $produto->sku }}</td>
                        <td>
                            <div class="fw-semibold">{{ $produto->nome }}</div>
                            <small class="text-muted">{{ $produto->codigo_barras ?: '-' }}</small>
                        </td>
                        <td>{{ $produto->categoria->nome }}</td>
                        <td>{{ $produto->unidadePrincipal->sigla }}</td>
                        <td>R$ {{ number_format((float) ($produto->preco_venda_atual ?? 0), 2, ',', '.') }}</td>
                        <td>{{ number_format((float) ($produto->margem_ref_percentual ?? 0), 2, ',', '.') }}%</td>
                        <td>
                            <div>{{ number_format($estoqueAtual, 3, ',', '.') }}</div>
                            <small class="text-muted">Min: {{ number_format($estoqueMinimo, 3, ',', '.') }}</small>
                        </td>
                        <td>
                            @if ($produto->cobertura_dias !== null)
                                {{ number_format((float) $produto->cobertura_dias, 1, ',', '.') }} dias
                            @else
                                <span class="text-muted">Sem giro</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-label-{{ $produto->ativo ? 'success' : 'secondary' }}">{{ $produto->ativo ? 'Ativo' : 'Inativo' }}</span>
                            @if ($baixo)
                                <span class="badge bg-label-warning">Baixo estoque</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('produtos.show', $produto) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                            @perm('produtos.manage')
                                <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-sm btn-outline-info">Editar</a>
                                <form action="{{ route('produtos.destroy', $produto) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja remover este produto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            @endperm
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-5">Nenhum produto encontrado para os filtros aplicados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($produtos->hasPages())
        <div class="card-footer">
            {{ $produtos->links() }}
        </div>
    @endif
</div>
@endsection
