<div class="card">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Nome *</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome', $fornecedor->nome) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">CNPJ</label>
                <input type="text" name="cnpj" class="form-control" value="{{ old('cnpj', $fornecedor->cnpj) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $fornecedor->telefone) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Contato</label>
                <input type="text" name="contato" class="form-control" value="{{ old('contato', $fornecedor->contato) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $fornecedor->email) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Endereço</label>
                <textarea name="endereco" class="form-control" rows="3">{{ old('endereco', $fornecedor->endereco) }}</textarea>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="ativo" name="ativo" @checked(old('ativo', $fornecedor->ativo ?? true))>
                    <label class="form-check-label" for="ativo">Fornecedor ativo</label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-4 d-flex gap-2">
    <button class="btn btn-primary">{{ $isEdit ? 'Atualizar' : 'Salvar' }}</button>
    <a href="{{ route('fornecedores.index') }}" class="btn btn-outline-secondary">Cancelar</a>
</div>
