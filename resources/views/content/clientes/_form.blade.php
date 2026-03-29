@php
    $isEdit = isset($cliente) && $cliente->exists;
    $tipoPessoa = old('tipo_pessoa', $cliente->tipo_pessoa ?? 'PF');
    $selectedUf = old('uf', $cliente->uf ?? '');
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Corrija os campos destacados.</strong>
    </div>
@endif

<div class="row g-6">
    <div class="col-lg-8">
        <div class="card mb-6">
            <div class="card-header">
                <h5 class="mb-0">Dados Principais</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-3">
                        <label for="codigo" class="form-label">Codigo Interno</label>
                        <input type="text" id="codigo" name="codigo" class="form-control @error('codigo') is-invalid @enderror" value="{{ old('codigo', $cliente->codigo) }}" placeholder="CLI-0001">
                        @error('codigo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="tipo_pessoa" class="form-label">Pessoa</label>
                        <select id="tipo_pessoa" name="tipo_pessoa" class="form-select @error('tipo_pessoa') is-invalid @enderror">
                            <option value="PF" @selected($tipoPessoa === 'PF')>Pessoa Fisica</option>
                            <option value="PJ" @selected($tipoPessoa === 'PJ')>Pessoa Juridica</option>
                        </select>
                        @error('tipo_pessoa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="nome" class="form-label" id="label_nome">{{ $tipoPessoa === 'PJ' ? 'Razao Social' : 'Nome Completo' }}</label>
                        <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $cliente->nome) }}" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="cpf_cnpj" class="form-label" id="label_documento">{{ $tipoPessoa === 'PJ' ? 'CNPJ' : 'CPF' }}</label>
                        <div class="input-group">
                            <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="form-control @error('cpf_cnpj') is-invalid @enderror" value="{{ old('cpf_cnpj', $cliente->cpf_cnpj) }}" required>
                            <button class="btn btn-outline-primary d-none" type="button" id="btn_buscar_cnpj">Buscar CNPJ</button>
                            @error('cpf_cnpj')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="rg_ie" class="form-label" id="label_rg_ie">{{ $tipoPessoa === 'PJ' ? 'Inscricao Estadual' : 'RG' }}</label>
                        <input type="text" id="rg_ie" name="rg_ie" class="form-control @error('rg_ie') is-invalid @enderror" value="{{ old('rg_ie', $cliente->rg_ie) }}">
                        @error('rg_ie')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 campo-pj {{ $tipoPessoa === 'PF' ? 'd-none' : '' }}">
                        <label for="nome_fantasia" class="form-label">Nome Fantasia</label>
                        <input type="text" id="nome_fantasia" name="nome_fantasia" class="form-control @error('nome_fantasia') is-invalid @enderror" value="{{ old('nome_fantasia', $cliente->nome_fantasia) }}">
                        @error('nome_fantasia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-6">
            <div class="card-header">
                <h5 class="mb-0">Endereco</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-2">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" id="cep" name="cep" class="form-control @error('cep') is-invalid @enderror" value="{{ old('cep', $cliente->cep) }}">
                        @error('cep')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-7">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" id="logradouro" name="logradouro" class="form-control @error('logradouro') is-invalid @enderror" value="{{ old('logradouro', $cliente->logradouro) }}">
                        @error('logradouro')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="numero" class="form-label">Numero</label>
                        <input type="text" id="numero" name="numero" class="form-control @error('numero') is-invalid @enderror" value="{{ old('numero', $cliente->numero) }}">
                        @error('numero')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" id="complemento" name="complemento" class="form-control @error('complemento') is-invalid @enderror" value="{{ old('complemento', $cliente->complemento) }}">
                        @error('complemento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" id="bairro" name="bairro" class="form-control @error('bairro') is-invalid @enderror" value="{{ old('bairro', $cliente->bairro) }}">
                        @error('bairro')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="uf" class="form-label">UF</label>
                        <select id="uf" name="uf" class="form-select @error('uf') is-invalid @enderror">
                            <option value="">Selecione</option>
                            @foreach ($ufs as $sigla => $nomeUf)
                                <option value="{{ $sigla }}" @selected($selectedUf === $sigla)>{{ $sigla }}</option>
                            @endforeach
                        </select>
                        @error('uf')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="codigo_ibge" class="form-label">Cod. IBGE</label>
                        <input type="text" id="codigo_ibge" name="codigo_ibge" class="form-control @error('codigo_ibge') is-invalid @enderror" value="{{ old('codigo_ibge', $cliente->codigo_ibge) }}">
                        @error('codigo_ibge')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="cidade" class="form-label">Cidade</label>
                        <select id="cidade" name="cidade" class="form-select @error('cidade') is-invalid @enderror">
                            <option value="">Selecione</option>
                            @foreach ($cidades as $cidade)
                                <option value="{{ $cidade }}" @selected(old('cidade', $cliente->cidade) === $cidade)>{{ $cidade }}</option>
                            @endforeach
                        </select>
                        @error('cidade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="pais" class="form-label">Pais</label>
                        <input type="text" id="pais" name="pais" class="form-control @error('pais') is-invalid @enderror" value="{{ old('pais', $cliente->pais ?? 'Brasil') }}">
                        @error('pais')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-6">
            <div class="card-header">
                <h5 class="mb-0">Contatos</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" id="telefone" name="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone', $cliente->telefone) }}">
                        @error('telefone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" id="celular" name="celular" class="form-control @error('celular') is-invalid @enderror" value="{{ old('celular', $cliente->celular) }}">
                        @error('celular')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 campo-pj {{ $tipoPessoa === 'PF' ? 'd-none' : '' }}">
                        <label for="contato_nome" class="form-label">Contato</label>
                        <input type="text" id="contato_nome" name="contato_nome" class="form-control @error('contato_nome') is-invalid @enderror" value="{{ old('contato_nome', $cliente->contato_nome) }}">
                        @error('contato_nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $cliente->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-6">
            <div class="card-header">
                <h5 class="mb-0">Extra</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label for="data_nascimento_fundacao" class="form-label" id="label_data">{{ $tipoPessoa === 'PJ' ? 'Data de Fundacao' : 'Data de Nascimento' }}</label>
                        <input type="date" id="data_nascimento_fundacao" name="data_nascimento_fundacao" class="form-control @error('data_nascimento_fundacao') is-invalid @enderror" value="{{ old('data_nascimento_fundacao', optional($cliente->data_nascimento_fundacao)->format('Y-m-d')) }}">
                        @error('data_nascimento_fundacao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 campo-pf {{ $tipoPessoa === 'PJ' ? 'd-none' : '' }}">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select id="sexo" name="sexo" class="form-select @error('sexo') is-invalid @enderror">
                            <option value="">Selecione</option>
                            <option value="M" @selected(old('sexo', $cliente->sexo) === 'M')>Masculino</option>
                            <option value="F" @selected(old('sexo', $cliente->sexo) === 'F')>Feminino</option>
                            <option value="N" @selected(old('sexo', $cliente->sexo) === 'N')>Nao informado</option>
                        </select>
                        @error('sexo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="saldo_credito" class="form-label">Saldo Credito (R$)</label>
                        <input type="number" step="0.01" min="0" id="saldo_credito" name="saldo_credito" class="form-control @error('saldo_credito') is-invalid @enderror" value="{{ old('saldo_credito', $cliente->saldo_credito ?? 0) }}">
                        @error('saldo_credito')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="limite_prazo" class="form-label">Limite a Prazo (R$)</label>
                        <input type="number" step="0.01" min="0" id="limite_prazo" name="limite_prazo" class="form-control @error('limite_prazo') is-invalid @enderror" value="{{ old('limite_prazo', $cliente->limite_prazo ?? 0) }}">
                        @error('limite_prazo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label d-block">Situacao</label>
                        <input type="hidden" name="ativo" value="0">
                        <div class="form-check form-switch mt-1">
                            <input class="form-check-input" type="checkbox" id="ativo" name="ativo" value="1" @checked(old('ativo', $cliente->ativo ?? true))>
                            <label class="form-check-label" for="ativo">Cliente ativo</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card mb-6">
            <div class="card-header">
                <h5 class="mb-0">Observacoes</h5>
            </div>
            <div class="card-body">
                <textarea name="observacoes" id="observacoes" rows="4" class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes', $cliente->observacoes) }}</textarea>
                @error('observacoes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 d-flex gap-3">
        <button class="btn btn-primary" type="submit">{{ $isEdit ? 'Atualizar cliente' : 'Salvar cliente' }}</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</div>
