@extends('layouts/contentNavbarLayout')

@section('title', 'Nova Movimentacao')

@section('page-script')
@vite(['resources/assets/js/movimentacoes-estoque-form.js'])
@endsection

@section('content')
<h4 class="mb-6">Nova Movimentacao de Estoque</h4>

@if ($errors->any())
    <div class="alert alert-danger">Revise os campos destacados.</div>
@endif

<form method="POST" action="{{ route('movimentacoes-estoque.store') }}" id="movimentacao-form">
    @csrf
    <div class="row g-6">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-7">
                            <label class="form-label" for="produto_id">Produto *</label>
                            <select id="produto_id" name="produto_id" class="form-select @error('produto_id') is-invalid @enderror" required>
                                <option value="">Selecione</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}" data-controla-lote="{{ $produto->controla_lote ? '1' : '0' }}" data-controla-validade="{{ $produto->controla_validade ? '1' : '0' }}" @selected((string) old('produto_id') === (string) $produto->id)>
                                        {{ $produto->sku }} - {{ $produto->nome }} (saldo: {{ number_format((float) ($produto->estoqueSaldo->quantidade_atual ?? 0), 3, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('produto_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="tipo">Tipo *</label>
                            <select id="tipo" name="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo }}" @selected(old('tipo') === $tipo)>{{ $tipo }}</option>
                                @endforeach
                            </select>
                            @error('tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2 ajuste-direcao-wrap d-none">
                            <label class="form-label" for="ajuste_direcao">Direcao</label>
                            <select id="ajuste_direcao" name="ajuste_direcao" class="form-select @error('ajuste_direcao') is-invalid @enderror">
                                <option value="">Selecione</option>
                                <option value="ENTRADA" @selected(old('ajuste_direcao') === 'ENTRADA')>Entrada</option>
                                <option value="SAIDA" @selected(old('ajuste_direcao') === 'SAIDA')>Saida</option>
                            </select>
                            @error('ajuste_direcao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="quantidade">Quantidade *</label>
                            <input type="number" step="0.001" min="0.001" id="quantidade" name="quantidade" class="form-control @error('quantidade') is-invalid @enderror" value="{{ old('quantidade') }}" required>
                            @error('quantidade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="origem">Origem *</label>
                            <input type="text" id="origem" name="origem" class="form-control @error('origem') is-invalid @enderror" value="{{ old('origem') }}" placeholder="COMPRA, VENDA, AJUSTE..." required>
                            @error('origem')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="documento_ref">Documento Ref.</label>
                            <input type="text" id="documento_ref" name="documento_ref" class="form-control @error('documento_ref') is-invalid @enderror" value="{{ old('documento_ref') }}" placeholder="NF, Pedido, etc">
                            @error('documento_ref')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 lote-wrap d-none">
                            <label class="form-label" for="lote">Lote</label>
                            <input type="text" id="lote" name="lote" class="form-control @error('lote') is-invalid @enderror" value="{{ old('lote') }}">
                            @error('lote')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 lote-wrap d-none">
                            <label class="form-label" for="serial">Serial</label>
                            <input type="text" id="serial" name="serial" class="form-control @error('serial') is-invalid @enderror" value="{{ old('serial') }}">
                            @error('serial')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 validade-wrap d-none">
                            <label class="form-label" for="validade">Validade</label>
                            <input type="date" id="validade" name="validade" class="form-control @error('validade') is-invalid @enderror" value="{{ old('validade') }}">
                            @error('validade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 entrada-wrap d-none">
                            <label class="form-label" for="custo_unitario">Custo Unitario</label>
                            <input type="number" step="0.0001" min="0" id="custo_unitario" name="custo_unitario" class="form-control @error('custo_unitario') is-invalid @enderror" value="{{ old('custo_unitario') }}">
                            @error('custo_unitario')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="observacao">Observacao</label>
                            <textarea id="observacao" name="observacao" rows="3" class="form-control @error('observacao') is-invalid @enderror">{{ old('observacao') }}</textarea>
                            @error('observacao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6>Regras</h6>
                    <ul class="mb-0">
                        <li>Entrada adiciona saldo.</li>
                        <li>Saida reduz saldo.</li>
                        <li>Ajuste exige direcao.</li>
                        <li>Produto com lote exige lote informado.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Registrar Movimentacao</button>
            <a href="{{ route('movimentacoes-estoque.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </div>
</form>
@endsection
