@if ($errors->any())
    <div class="alert alert-danger">Corrija os campos destacados.</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-3">
                <label class="form-label" for="sigla">Sigla *</label>
                <input type="text" id="sigla" name="sigla" class="form-control @error('sigla') is-invalid @enderror" value="{{ old('sigla', $unidadeMedida->sigla) }}" required>
                @error('sigla')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-5">
                <label class="form-label" for="nome">Nome *</label>
                <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $unidadeMedida->nome) }}" required>
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2">
                <label class="form-label" for="casas_decimais">Casas Decimais *</label>
                <input type="number" id="casas_decimais" name="casas_decimais" class="form-control @error('casas_decimais') is-invalid @enderror" value="{{ old('casas_decimais', $unidadeMedida->casas_decimais ?? 3) }}" min="0" max="6" required>
                @error('casas_decimais')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2">
                <label class="form-label d-block">Status</label>
                <input type="hidden" name="ativo" value="0">
                <div class="form-check form-switch mt-2">
                    <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" @checked(old('ativo', $unidadeMedida->ativo ?? true))>
                    <label for="ativo" class="form-check-label">Ativa</label>
                </div>
            </div>
        </div>
        <div class="mt-5 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('unidades-medida.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </div>
</div>
