<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaProdutoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nome' => trim((string) $this->input('nome')),
            'ativo' => $this->boolean('ativo', true),
        ]);
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:120', 'unique:categorias_produto,nome'],
            'ativo' => ['sometimes', 'boolean'],
        ];
    }
}
