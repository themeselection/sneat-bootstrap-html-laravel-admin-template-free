<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTabelaPrecoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nome' => trim((string) $this->input('nome')),
            'codigo' => strtoupper(trim((string) $this->input('codigo'))),
            'tipo' => strtoupper((string) $this->input('tipo')),
            'ativo' => $this->boolean('ativo', true),
        ]);
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:120', 'unique:tabelas_preco,nome'],
            'codigo' => ['required', 'string', 'max:40', 'unique:tabelas_preco,codigo'],
            'tipo' => ['required', Rule::in(['VAREJO', 'ATACADO', 'PROMOCAO', 'ESPECIAL'])],
            'prioridade' => ['required', 'integer', 'min:-999', 'max:999'],
            'ativo' => ['sometimes', 'boolean'],
        ];
    }
}
