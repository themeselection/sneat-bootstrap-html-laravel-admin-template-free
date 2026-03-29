<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ValidatesCpfCnpj;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClienteRequest extends FormRequest
{
    use ValidatesCpfCnpj;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'tipo_pessoa' => strtoupper((string) $this->input('tipo_pessoa')),
            'cpf_cnpj' => $this->onlyDigits($this->input('cpf_cnpj')),
            'telefone' => $this->onlyDigits($this->input('telefone')),
            'celular' => $this->onlyDigits($this->input('celular')),
            'cep' => $this->onlyDigits($this->input('cep')),
            'uf' => strtoupper((string) $this->input('uf')),
            'sexo' => $this->input('sexo') ? strtoupper((string) $this->input('sexo')) : null,
            'ativo' => $this->boolean('ativo', true),
        ]);
    }

    public function rules(): array
    {
        return [
            'codigo' => ['nullable', 'string', 'max:20', 'unique:clientes,codigo'],
            'tipo_pessoa' => ['required', Rule::in(['PF', 'PJ'])],
            'nome' => ['required', 'string', 'max:255'],
            'nome_fantasia' => ['nullable', 'string', 'max:255'],
            'cpf_cnpj' => ['required', 'string', 'min:11', 'max:14', 'unique:clientes,cpf_cnpj'],
            'rg_ie' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255', 'unique:clientes,email'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'celular' => ['nullable', 'string', 'max:20'],
            'contato_nome' => ['nullable', 'string', 'max:120'],
            'cep' => ['nullable', 'string', 'max:8'],
            'logradouro' => ['nullable', 'string', 'max:255'],
            'numero' => ['nullable', 'string', 'max:20'],
            'complemento' => ['nullable', 'string', 'max:120'],
            'bairro' => ['nullable', 'string', 'max:120'],
            'cidade' => ['nullable', 'string', 'max:120'],
            'uf' => ['nullable', 'string', 'size:2'],
            'codigo_ibge' => ['nullable', 'string', 'max:10'],
            'pais' => ['required', 'string', 'max:80'],
            'data_nascimento_fundacao' => ['nullable', 'date'],
            'sexo' => ['nullable', Rule::in(['M', 'F', 'N'])],
            'observacoes' => ['nullable', 'string'],
            'ativo' => ['sometimes', 'boolean'],
            'saldo_credito' => ['nullable', 'numeric', 'min:0'],
            'limite_prazo' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $doc = (string) $this->input('cpf_cnpj');
            $tipo = $this->input('tipo_pessoa');

            if ($tipo === 'PF' && !$this->isValidCpf($doc)) {
                $validator->errors()->add('cpf_cnpj', 'CPF invalido.');
            }

            if ($tipo === 'PJ' && !$this->isValidCnpj($doc)) {
                $validator->errors()->add('cpf_cnpj', 'CNPJ invalido.');
            }
        });
    }
}
