<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTabelaPrecoRequest extends FormRequest
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
        $id = (int) $this->route('tabela_preco')->id;

        return [
            'nome' => ['required', 'string', 'max:120', Rule::unique('tabelas_preco', 'nome')->ignore($id)],
            'codigo' => ['required', 'string', 'max:40', Rule::unique('tabelas_preco', 'codigo')->ignore($id)],
            'tipo' => ['required', Rule::in(['VAREJO', 'ATACADO', 'PROMOCAO', 'ESPECIAL'])],
            'prioridade' => ['required', 'integer', 'min:-999', 'max:999'],
            'ativo' => ['sometimes', 'boolean'],
        ];
    }
}
