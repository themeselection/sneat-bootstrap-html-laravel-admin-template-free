@if ($errors->any())
    <div class="alert alert-danger">Corrija os campos destacados.</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-5">
                <label class="form-label" for="nome">Nome *</label>
                <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $tabelaPreco->nome) }}" required>
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label class="form-label" for="codigo">Codigo *</label>
                <input type="text" id="codigo" name="codigo" class="form-control @error('codigo') is-invalid @enderror" value="{{ old('codigo', $tabelaPreco->codigo) }}" required>
                @error('codigo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2">
                <label class="form-label" for="tipo">Tipo *</label>
                <select id="tipo" name="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo }}" @selected(old('tipo', $tabelaPreco->tipo) === $tipo)>{{ $tipo }}</option>
                    @endforeach
                </select>
                @error('tipo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2">
                <label class="form-label" for="prioridade">Prioridade *</label>
                <input type="number" id="prioridade" name="prioridade" class="form-control @error('prioridade') is-invalid @enderror" value="{{ old('prioridade', $tabelaPreco->prioridade ?? 0) }}" required>
                @error('prioridade')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <input type="hidden" name="ativo" value="0">
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" @checked(old('ativo', $tabelaPreco->ativo ?? true))>
                    <label for="ativo" class="form-check-label">Tabela ativa</label>
                </div>
            </div>
        </div>

        <div class="mt-5 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('tabelas-preco.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </div>
</div>
