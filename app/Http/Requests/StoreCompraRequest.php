<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'itens' => array_values((array) $this->input('itens', [])),
        ]);
    }

    public function rules(): array
    {
        return [
            'fornecedor_id' => ['required', 'exists:fornecedores,id'],
            'filial_id' => ['nullable', 'exists:filiais,id'],
            'data_compra' => ['nullable', 'date'],
            'status' => ['nullable', Rule::in(['RASCUNHO', 'CONFIRMADA'])],
            'vencimento' => ['nullable', 'date'],
            'observacoes' => ['nullable', 'string'],
            'itens' => ['required', 'array', 'min:1'],
            'itens.*.produto_id' => ['required', 'exists:produtos,id'],
            'itens.*.quantidade' => ['required', 'numeric', 'gt:0'],
            'itens.*.preco_unitario' => ['required', 'numeric', 'min:0'],
            'itens.*.numero_lote' => ['nullable', 'string', 'max:80'],
            'itens.*.data_validade' => ['nullable', 'date'],
        ];
    }
}
