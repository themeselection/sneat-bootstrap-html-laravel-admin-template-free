<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnidadeMedidaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'sigla' => strtoupper(trim((string) $this->input('sigla'))),
            'nome' => trim((string) $this->input('nome')),
            'ativo' => $this->boolean('ativo', true),
        ]);
    }

    public function rules(): array
    {
        return [
            'sigla' => ['required', 'string', 'max:20', 'unique:unidades_medida,sigla'],
            'nome' => ['required', 'string', 'max:80'],
            'casas_decimais' => ['required', 'integer', 'min:0', 'max:6'],
            'ativo' => ['sometimes', 'boolean'],
        ];
    }
}
