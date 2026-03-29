<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoriaProdutoRequest extends FormRequest
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
        $id = (int) $this->route('categoria_produto')->id;

        return [
            'nome' => ['required', 'string', 'max:120', Rule::unique('categorias_produto', 'nome')->ignore($id)],
            'ativo' => ['sometimes', 'boolean'],
        ];
    }
}
