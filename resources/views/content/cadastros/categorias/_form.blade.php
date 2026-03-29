@if ($errors->any())
    <div class="alert alert-danger">Corrija os campos destacados.</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-8">
                <label class="form-label" for="nome">Nome *</label>
                <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $categoriaProduto->nome) }}" required>
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label d-block">Status</label>
                <input type="hidden" name="ativo" value="0">
                <div class="form-check form-switch mt-2">
                    <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" @checked(old('ativo', $categoriaProduto->ativo ?? true))>
                    <label for="ativo" class="form-check-label">Ativa</label>
                </div>
            </div>
        </div>
        <div class="mt-5 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('categorias-produto.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </div>
</div>
