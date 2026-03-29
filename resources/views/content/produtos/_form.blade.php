@php
    $isEdit = isset($produto) && $produto->exists;
    $precoCusto = old('preco_custo', $preco['preco_custo'] ?? 0);
    $precoVenda = old('preco_venda', $preco['preco_venda'] ?? 0);
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Revise os campos destacados para continuar.</strong>
    </div>
@endif

<div class="row g-6">
    <div class="col-lg-8">
        <div class="card mb-6">
            <div class="card-header">
                <h5 class="mb-0">Informacoes Gerais</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label for="sku" class="form-label">SKU *</label>
                        <input type="text" id="sku" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku', $produto->sku) }}" required>
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <label for="nome" class="form-label">Nome *</label>
                        <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $produto->nome) }}" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="categoria_id" class="form-label">Categoria *</label>
                        <select id="categoria_id" name="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror" required>
                            <option value="">Selecione</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" @selected((string) old('categoria_id', $produto->categoria_id) === (string) $categoria->id)>{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="unidade_principal_id" class="form-label">Unidade Principal *</label>
                        <select id="unidade_principal_id" name="unidade_principal_id" class="form-select @error('unidade_principal_id') is-invalid @enderror" required>
                            <option value="">Selecione</option>
                            @foreach ($unidades as $unidade)
                                <option value="{{ $unidade->id }}" @selected((string) old('unidade_principal_id', $produto->unidade_principal_id) === (string) $unidade->id)>
                                    {{ $unidade->sigla }} - {{ $unidade->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('unidade_principal_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="codigo_barras" class="form-label">Codigo de Barras</label>
                        <input type="text" id="codigo_barras" name="codigo_barras" class="form-control @error('codigo_barras') is-invalid @enderror" value="{{ old('codigo_barras', $produto->codigo_barras) }}">
                        @error('codigo_barras')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" id="marca" name="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ old('marca', $produto->marca) }}">
                        @error('marca')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="ncm" class="form-label">NCM</label>
                        <input type="text" id="ncm" name="ncm" class="form-control @error('ncm') is-invalid @enderror" value="{{ old('ncm', $produto->ncm) }}">
                        @error('ncm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="cest" class="form-label">CEST</label>
                        <input type="text" id="cest" name="cest" class="form-control @error('cest') is-invalid @enderror" value="{{ old('cest', $produto->cest) }}">
                        @error('cest')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="descricao" class="form-label">Descricao</label>
                        <textarea id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="3">{{ old('descricao', $produto->descricao) }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-6">
            <div class="card-header">
                <h5 class="mb-0">Observacoes</h5>
            </div>
            <div class="card-body">
                <textarea id="observacoes" name="observacoes" class="form-control @error('observacoes') is-invalid @enderror" rows="4">{{ old('observacoes', $produto->observacoes) }}</textarea>
                @error('observacoes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-6">
            <div class="card-header">
                <h5 class="mb-0">Preco e Estoque</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label for="tabela_preco_id" class="form-label">Tabela de Preco *</label>
                        <select id="tabela_preco_id" name="tabela_preco_id" class="form-select @error('tabela_preco_id') is-invalid @enderror" required>
                            @foreach ($tabelasPreco as $tabela)
                                <option value="{{ $tabela->id }}" @selected((string) old('tabela_preco_id', $preco['tabela_preco_id']) === (string) $tabela->id)>
                                    {{ $tabela->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('tabela_preco_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="preco_custo" class="form-label">Preco Custo (R$) *</label>
                        <input type="number" step="0.0001" min="0" id="preco_custo" name="preco_custo" class="form-control @error('preco_custo') is-invalid @enderror" value="{{ $precoCusto }}" required>
                        @error('preco_custo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="preco_venda" class="form-label">Preco Venda (R$) *</label>
                        <input type="number" step="0.0001" min="0" id="preco_venda" name="preco_venda" class="form-control @error('preco_venda') is-invalid @enderror" value="{{ $precoVenda }}" required>
                        @error('preco_venda')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="margem_visual" class="form-label">Margem (%)</label>
                        <input type="text" id="margem_visual" class="form-control" value="0.00" readonly>
                    </div>
                    <div class="col-12">
                        <label for="estoque_minimo" class="form-label">Estoque Minimo *</label>
                        <input type="number" step="0.001" min="0" id="estoque_minimo" name="estoque_minimo" class="form-control @error('estoque_minimo') is-invalid @enderror" value="{{ old('estoque_minimo', $estoqueMinimo) }}" required>
                        @error('estoque_minimo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (!$isEdit)
                        <div class="col-12">
                            <div class="alert alert-info mb-0">
                                Estoque inicial sera gravado como <strong>0</strong>.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card mb-6">
            <div class="card-header">
                <h5 class="mb-0">Regras</h5>
            </div>
            <div class="card-body">
                <input type="hidden" name="ativo" value="0">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="ativo" name="ativo" value="1" @checked(old('ativo', $produto->ativo ?? true))>
                    <label class="form-check-label" for="ativo">Produto ativo</label>
                </div>

                <input type="hidden" name="permite_venda" value="0">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="permite_venda" name="permite_venda" value="1" @checked(old('permite_venda', $produto->permite_venda ?? true))>
                    <label class="form-check-label" for="permite_venda">Permite venda</label>
                </div>

                <input type="hidden" name="permite_compra" value="0">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="permite_compra" name="permite_compra" value="1" @checked(old('permite_compra', $produto->permite_compra ?? true))>
                    <label class="form-check-label" for="permite_compra">Permite compra</label>
                </div>

                <input type="hidden" name="controla_lote" value="0">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="controla_lote" name="controla_lote" value="1" @checked(old('controla_lote', $produto->controla_lote ?? false))>
                    <label class="form-check-label" for="controla_lote">Controla lote</label>
                </div>

                <input type="hidden" name="controla_validade" value="0">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="controla_validade" name="controla_validade" value="1" @checked(old('controla_validade', $produto->controla_validade ?? false))>
                    <label class="form-check-label" for="controla_validade">Controla validade</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 d-flex gap-3">
        <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Atualizar produto' : 'Salvar produto' }}</button>
        <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</div>
