@extends('layouts/contentNavbarLayout')

@section('title', 'Vendas e Pedidos')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-6 gap-3">
    <div>
        <h4 class="mb-1">Nucleo Comercial</h4>
        <p class="mb-0 text-muted">Orcamentos, pedidos, vendas, faturamento e analise comercial.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('documentos-comerciais.export-csv', request()->query()) }}" class="btn btn-outline-primary">
            <i class="icon-base bx bx-download me-1"></i>Exportar CSV
        </a>
        @perm('vendas.pdv.use')
            <a href="{{ route('pdv.index') }}" class="btn btn-outline-primary">
                <i class="icon-base bx bx-desktop me-1"></i>PDV Rapido
            </a>
        @endperm
        @perm('vendas.documentos.manage')
            <a href="{{ route('documentos-comerciais.create', ['tipo' => 'ORCAMENTO']) }}" class="btn btn-primary">
                <i class="icon-base bx bx-plus me-1"></i>Novo Documento
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
@if (session('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
@endif

@php
    $importFeedback = session('import_feedback');
@endphp

@perm('vendas.documentos.importar_legado')
    <div class="card mb-6">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                <div>
                    <h6 class="mb-1">Importar Vendas Legadas (PDF)</h6>
                    <p class="text-muted mb-0">Fluxo homologado para os modelos PDF enviados (ex.: 1.pdf e a1.pdf).</p>
                </div>
            </div>
            <form method="POST" action="{{ route('documentos-comerciais.importar-pdf-legado') }}" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-lg-4">
                    <label class="form-label" for="arquivos">Arquivos PDF</label>
                    <input type="file" class="form-control @error('arquivos') is-invalid @enderror @error('arquivos.*') is-invalid @enderror" id="arquivos" name="arquivos[]" accept="application/pdf" multiple>
                    @error('arquivos')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('arquivos.*')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="pasta_arquivos">Ou selecione uma pasta</label>
                    <input
                        type="file"
                        class="form-control @error('pasta_arquivos') is-invalid @enderror @error('pasta_arquivos.*') is-invalid @enderror"
                        id="pasta_arquivos"
                        name="pasta_arquivos[]"
                        webkitdirectory
                        directory
                        multiple>
                    <small class="text-muted">Todos os PDFs da pasta selecionada serao importados.</small>
                    @error('pasta_arquivos')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('pasta_arquivos.*')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="caminho_pasta">Pasta local (sem upload)</label>
                    <input
                        type="text"
                        class="form-control @error('caminho_pasta') is-invalid @enderror"
                        id="caminho_pasta"
                        name="caminho_pasta"
                        value="{{ old('caminho_pasta') }}"
                        placeholder="/Users/mateuscosme/Documents/pasta sem título">
                    <small class="text-muted">Use esta opcao para volume alto (evita erro 413/PostTooLarge).</small>
                    @error('caminho_pasta')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-12 d-flex align-items-end">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="icon-base bx bx-upload me-1"></i>Importar Como Faturada
                    </button>
                </div>
            </form>

            @if (!empty($importFeedback))
                <hr>
                @if (!empty($importFeedback['stats']))
                    <div class="row g-3 mb-4">
                        <div class="col-md-2"><div class="p-3 border rounded"><small class="text-muted d-block">Total</small><strong>{{ $importFeedback['stats']['total'] ?? 0 }}</strong></div></div>
                        <div class="col-md-2"><div class="p-3 border rounded"><small class="text-muted d-block">Importados</small><strong class="text-success">{{ $importFeedback['stats']['sucesso'] ?? 0 }}</strong></div></div>
                        <div class="col-md-2"><div class="p-3 border rounded"><small class="text-muted d-block">Falhas</small><strong class="text-danger">{{ $importFeedback['stats']['falhas'] ?? 0 }}</strong></div></div>
                        <div class="col-md-2"><div class="p-3 border rounded"><small class="text-muted d-block">Ignorados</small><strong class="text-warning">{{ $importFeedback['stats']['ignorados'] ?? 0 }}</strong></div></div>
                        <div class="col-md-4"><div class="p-3 border rounded"><small class="text-muted d-block">Tempo de processamento</small><strong>{{ number_format((($importFeedback['stats']['tempo_ms'] ?? 0) / 1000), 2, ',', '.') }}s</strong></div></div>
                    </div>
                @endif
                <div class="row g-4">
                    <div class="col-lg-6">
                        <h6 class="mb-2">Importados</h6>
                        <ul class="list-group">
                            @forelse (($importFeedback['sucesso'] ?? []) as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item['arquivo'] }}</span>
                                    <span class="badge bg-label-success">{{ $item['numero'] }}</span>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Nenhum arquivo importado nesta execucao.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <h6 class="mb-2">Falhas</h6>
                        <ul class="list-group">
                            @forelse (($importFeedback['falhas'] ?? []) as $item)
                                <li class="list-group-item">
                                    <div class="fw-semibold">{{ $item['arquivo'] }}</div>
                                    <small class="text-danger">{{ $item['erro'] }}</small>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Sem falhas na ultima importacao.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <h6 class="mb-2">Ignorados (duplicidade)</h6>
                        <ul class="list-group">
                            @forelse (($importFeedback['ignorados'] ?? []) as $item)
                                <li class="list-group-item">
                                    <div class="fw-semibold">{{ $item['arquivo'] }}</div>
                                    <small class="text-warning">{{ $item['motivo'] }}</small>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">Nenhum arquivo ignorado.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endperm

<div class="row g-4 mb-6">
    <div class="col-xl-3 col-md-6">
        <div class="card border-start border-primary border-3">
            <div class="card-body">
                <small class="text-muted">Total de documentos</small>
                <h4 class="mb-0">{{ number_format($cards['total'], 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-start border-warning border-3">
            <div class="card-body">
                <small class="text-muted">Orcamentos pendentes</small>
                <h4 class="mb-0">{{ number_format($cards['orcamentos_pendentes'], 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-start border-info border-3">
            <div class="card-body">
                <small class="text-muted">Aguardando faturamento</small>
                <h4 class="mb-0">{{ number_format($cards['aguardando_faturamento'], 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-start border-success border-3">
            <div class="card-body">
                <small class="text-muted">Faturados no mes</small>
                <h4 class="mb-0">{{ number_format($cards['faturados_mes'], 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="card mb-6">
    <div class="card-body">
        <form method="GET" action="{{ route('documentos-comerciais.index') }}" class="row g-3">
            <div class="col-lg-2">
                <label class="form-label" for="tipo">Tipo</label>
                <select id="tipo" name="tipo" class="form-select">
                    <option value="">Todos</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo }}" @selected(($filtros['tipo'] ?? '') === $tipo)>{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <label class="form-label" for="status">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="">Todos</option>
                    @foreach ($statusList as $status)
                        <option value="{{ $status }}" @selected(($filtros['status'] ?? '') === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3">
                <label class="form-label" for="cliente_id">Cliente</label>
                <select id="cliente_id" name="cliente_id" class="form-select">
                    <option value="">Todos</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" @selected((string) ($filtros['cliente_id'] ?? '') === (string) $cliente->id)>{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <label class="form-label" for="numero">Numero</label>
                <input type="text" id="numero" name="numero" class="form-control" value="{{ $filtros['numero'] ?? '' }}" placeholder="ORC-202603...">
            </div>
            <div class="col-lg-1">
                <label class="form-label" for="data_inicio">De</label>
                <input type="date" id="data_inicio" name="data_inicio" class="form-control" value="{{ $filtros['data_inicio'] ?? '' }}">
            </div>
            <div class="col-lg-1">
                <label class="form-label" for="data_fim">Ate</label>
                <input type="date" id="data_fim" name="data_fim" class="form-control" value="{{ $filtros['data_fim'] ?? '' }}">
            </div>
            <div class="col-lg-1 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">OK</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Tipo</th>
                    <th>Cliente</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Total</th>
                    <th>Origem</th>
                    <th class="text-end">Acoes</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documentos as $documento)
                    <tr>
                        <td class="fw-semibold">{{ $documento->numero }}</td>
                        <td><span class="badge bg-label-primary">{{ $documento->tipo }}</span></td>
                        <td>{{ $documento->cliente->nome }}</td>
                        <td>
                            @php
                                $statusClass = match($documento->status) {
                                    'FATURADO' => 'success',
                                    'CANCELADO' => 'danger',
                                    'EM_SEPARACAO', 'AGUARDANDO_FATURAMENTO' => 'warning',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-label-{{ $statusClass }}">{{ $documento->status }}</span>
                        </td>
                        <td>{{ optional($documento->data_emissao)->format('d/m/Y H:i') }}</td>
                        <td>R$ {{ number_format((float) $documento->total_liquido, 2, ',', '.') }}</td>
                        <td>{{ $documento->origem?->numero ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('documentos-comerciais.show', $documento) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                            <a href="{{ route('documentos-comerciais.analise', $documento) }}" class="btn btn-sm btn-outline-info">Analise</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">Nenhum documento encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($documentos->hasPages())
        <div class="card-footer">{{ $documentos->links() }}</div>
    @endif
</div>
@endsection
