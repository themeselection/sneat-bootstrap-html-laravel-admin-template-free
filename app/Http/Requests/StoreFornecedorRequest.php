<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFornecedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:180'],
            'cnpj' => ['nullable', 'string', 'max:18', 'unique:fornecedores,cnpj'],
            'telefone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:180'],
            'endereco' => ['nullable', 'string'],
            'contato' => ['nullable', 'string', 'max:120'],
            'ativo' => ['nullable', 'boolean'],
        ];
    }
}
