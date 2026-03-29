<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFornecedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $fornecedorId = $this->route('fornecedor')?->id;

        return [
            'nome' => ['required', 'string', 'max:180'],
            'cnpj' => ['nullable', 'string', 'max:18', Rule::unique('fornecedores', 'cnpj')->ignore($fornecedorId)],
            'telefone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:180'],
            'endereco' => ['nullable', 'string'],
            'contato' => ['nullable', 'string', 'max:120'],
            'ativo' => ['nullable', 'boolean'],
        ];
    }
}
