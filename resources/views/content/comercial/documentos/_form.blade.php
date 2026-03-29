@php
    $statusOptionsByTipo = $statusOptionsByTipo ?? [];
    $regrasEdicao = $regrasEdicao ?? ['pode_editar' => true, 'permite_alterar_itens' => true, 'permite_alterar_cabecalho' => true, 'motivo' => null];
    $bloquearItens = $isEdit && !$regrasEdicao['permite_alterar_itens'];
    $bloquearCabecalho = $isEdit && !$regrasEdicao['permite_alterar_cabecalho'];
    $tipoAtual = old('tipo', $documento->tipo);
    $statusOptions = $statusOptionsByTipo[$tipoAtual] ?? ['RASCUNHO'];
    $statusAtual = old('status', $documento->status);
    if (!in_array($statusAtual, $statusOptions, true)) {
        $statusOptions[] = $statusAtual;
    }
    $clienteInicial = old('cliente_nome') ?: ($documento->cliente->nome ?? '');

    $existingItens = old('itens');
    if ($existingItens === null && $isEdit) {
        $existingItens = $documento->itens->map(fn($item) => [
            'produto_id' => $item->produto_id,
            'produto_nome' => $item->descricao,
            'produto_sku' => $item->metadata['produto_sku'] ?? ($item->produto?->sku ?? ''),
            'produto_unidade' => $item->unidade_sigla,
            'quantidade' => $item->quantidade,
            'preco_unitario' => $item->preco_unitario,
        ])->values()->all();
    }

    $existingItens = $existingItens ?: [[
        'produto_id' => '',
        'produto_nome' => '',
        'produto_sku' => '',
        'produto_unidade' => 'UN',
        'quantidade' => 1,
        'preco_unitario' => 0,
    ]];
@endphp

@if ($errors->any())
    <div class="alert alert-danger">Revise os campos para continuar.</div>
@endif
@if ($isEdit && ($regrasEdicao['pode_editar'] ?? true) === false)
    <div class="alert alert-warning">{{ $regrasEdicao['motivo'] ?? 'Documento em modo somente leitura.' }}</div>
@endif

<div class="row g-6">
    <div class="col-lg-8">
        <div class="card mb-6">
            <div class="card-header">
                <h5 class="mb-1">Itens do Documento</h5>
                <small class="text-muted">Pesquise por nome, SKU ou EAN e adicione rapidamente.</small>
            </div>
            <div class="card-body">
                <div class="mb-4 position-relative">
                    <label for="produto-search-input" class="form-label">Buscar Produto</label>
                    <input type="text" id="produto-search-input" class="form-control" placeholder="Digite nome, SKU ou EAN (min. 2 caracteres)" @disabled($bloquearItens)>
                    <div id="produto-search-results" class="list-group position-absolute w-100 shadow-sm" style="z-index: 20; max-height: 280px; overflow-y: auto; display: none;"></div>
                </div>

                <div class="table-responsive">
                    <table class="table" id="documento-itens-table">
                        <thead>
                            <tr>
                                <th style="width: 44%">Produto</th>
                                <th style="width: 14%">Qtd</th>
                                <th style="width: 18%">Preco Unit.</th>
                                <th style="width: 18%">Subtotal</th>
                                <th style="width: 6%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($existingItens as $index => $item)
                                <tr data-row>
                                    <td>
                                        <input type="hidden" name="itens[{{ $index }}][produto_id]" class="item-produto-id" value="{{ $item['produto_id'] ?? '' }}" required>
                                        <input type="text" class="form-control item-produto-nome" value="{{ trim(($item['produto_nome'] ?? '') . ' ' . (($item['produto_sku'] ?? '') ? '(' . $item['produto_sku'] . ')' : '')) }}" readonly placeholder="Selecione pelo campo de busca acima">
                                        <small class="text-muted item-produto-meta">{{ $item['produto_unidade'] ?? 'UN' }}</small>
                                    </td>
                                    <td>
                                        <input type="number" step="0.001" min="0.001" name="itens[{{ $index }}][quantidade]" class="form-control item-quantidade" value="{{ $item['quantidade'] ?? 1 }}" required @disabled($bloquearItens)>
                                    </td>
                                    <td>
                                        <input type="number" step="0.0001" min="0" name="itens[{{ $index }}][preco_unitario]" class="form-control item-preco" value="{{ $item['preco_unitario'] ?? 0 }}" required @disabled($bloquearItens)>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control item-subtotal" value="R$ 0,00" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-item-btn" @disabled($bloquearItens)>X</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="alert alert-info mb-0 mt-4">
                    Regra ativa: <strong>somente em ORCAMENTO</strong> o preco unitario do item pode ser alterado livremente. Em PEDIDO/VENDA o ajuste deve ser no cabecalho (desconto/acrescimo/impostos).
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Cabecalho</h5></div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label" for="tipo">Tipo *</label>
                    <select id="tipo" name="tipo" class="form-select" required data-tipo-documento @disabled($isEdit)>
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo }}" @selected(old('tipo', $documento->tipo) === $tipo)>{{ $tipo }}</option>
                        @endforeach
                    </select>
                    @if ($isEdit)
                        <input type="hidden" name="tipo" value="{{ old('tipo', $documento->tipo) }}">
                    @endif
                </div>
                <div class="mb-4">
                    <label class="form-label" for="status">Status *</label>
                    <select id="status" name="status" class="form-select" required data-status-documento @disabled($bloquearCabecalho)>
                        @foreach ($statusOptions as $status)
                            <option value="{{ $status }}" @selected(old('status', $documento->status) === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4 position-relative">
                    <label class="form-label" for="cliente-search-input">Cliente *</label>
                    <input type="hidden" id="cliente_id" name="cliente_id" value="{{ old('cliente_id', $documento->cliente_id) }}" required>
                    <input type="text" id="cliente-search-input" name="cliente_nome" class="form-control @error('cliente_id') is-invalid @enderror" value="{{ $clienteInicial }}" placeholder="Digite nome, CPF/CNPJ, telefone ou email" @disabled($bloquearCabecalho)>
                    @error('cliente_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="cliente-search-results" class="list-group position-absolute w-100 shadow-sm" style="z-index: 20; max-height: 280px; overflow-y: auto; display: none;"></div>
                    <small class="text-muted d-block mt-1" id="cliente-selected-meta"></small>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="filial_id">Filial</label>
                    <select id="filial_id" name="filial_id" class="form-select" @disabled($bloquearCabecalho)>
                        @foreach ($filiais as $filial)
                            <option value="{{ $filial->id }}" @selected((string) old('filial_id', $documento->filial_id) === (string) $filial->id)>{{ $filial->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="tabela_preco_id">Tabela de Preco</label>
                    <select id="tabela_preco_id" name="tabela_preco_id" class="form-select" @disabled($bloquearCabecalho)>
                        @foreach ($tabelasPreco as $tabela)
                            <option value="{{ $tabela->id }}" @selected((string) old('tabela_preco_id', $documento->tabela_preco_id) === (string) $tabela->id)>{{ $tabela->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label" for="desconto_total">Desconto</label>
                        <input type="number" step="0.01" min="0" id="desconto_total" name="desconto_total" class="form-control documento-ajuste" value="{{ old('desconto_total', $documento->desconto_total ?? 0) }}" @disabled($bloquearCabecalho)>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="acrescimo_total">Acrescimo</label>
                        <input type="number" step="0.01" min="0" id="acrescimo_total" name="acrescimo_total" class="form-control documento-ajuste" value="{{ old('acrescimo_total', $documento->acrescimo_total ?? 0) }}" @disabled($bloquearCabecalho)>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="impostos_total">Impostos</label>
                        <input type="number" step="0.01" min="0" id="impostos_total" name="impostos_total" class="form-control documento-ajuste" value="{{ old('impostos_total', $documento->impostos_total ?? 0) }}" @disabled($bloquearCabecalho)>
                    </div>
                </div>

                <hr class="my-4">
                <div class="d-flex justify-content-between mb-2"><span>Subtotal:</span><strong id="subtotal-preview">R$ 0,00</strong></div>
                <div class="d-flex justify-content-between"><span>Total Liquido:</span><strong id="total-preview">R$ 0,00</strong></div>
            </div>
        </div>

        <div class="card mb-6">
            <div class="card-header"><h5 class="mb-0">Observacoes</h5></div>
            <div class="card-body">
                <textarea name="observacoes" id="observacoes" rows="4" class="form-control" @disabled($bloquearCabecalho)>{{ old('observacoes', $documento->observacoes) }}</textarea>
            </div>
        </div>
    </div>

    <div class="col-12 d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Atualizar documento' : 'Salvar documento' }}</button>
        <a href="{{ route('documentos-comerciais.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</div>

<script>
window.documentoProdutoSearchUrl = @json(route('documentos-comerciais.buscar-produtos'));
window.documentoClienteSearchUrl = @json(route('documentos-comerciais.buscar-clientes'));
window.documentoStatusOptionsByTipo = @json($statusOptionsByTipo);
window.documentoRegrasEdicao = @json($regrasEdicao);
</script>
