<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDocumentoComercialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'desconto_total' => $this->input('desconto_total', 0),
            'acrescimo_total' => $this->input('acrescimo_total', 0),
            'impostos_total' => $this->input('impostos_total', 0),
            'itens' => array_values((array) $this->input('itens', [])),
        ]);
    }

    public function rules(): array
    {
        return [
            'tipo' => ['required', Rule::in(['ORCAMENTO', 'PREVENDA', 'PEDIDO', 'VENDA'])],
            'cliente_id' => ['required', 'exists:clientes,id'],
            'filial_id' => ['nullable', 'exists:filiais,id'],
            'tabela_preco_id' => ['nullable', 'exists:tabelas_preco,id'],
            'data_emissao' => ['nullable', 'date'],
            'validade_orcamento' => ['nullable', 'date'],
            'status' => [
                'nullable',
                Rule::in([
                    'RASCUNHO',
                    'PENDENTE',
                    'AGUARDANDO_PAGAMENTO',
                    'EM_SEPARACAO',
                    'AGUARDANDO_FATURAMENTO',
                    'CONCLUIDO',
                    'FATURADO',
                    'CANCELADO',
                ]),
            ],
            'desconto_total' => ['nullable', 'numeric', 'min:0'],
            'acrescimo_total' => ['nullable', 'numeric', 'min:0'],
            'impostos_total' => ['nullable', 'numeric', 'min:0'],
            'observacoes' => ['nullable', 'string'],
            'itens' => ['required', 'array', 'min:1'],
            'itens.*.produto_id' => ['required', 'exists:produtos,id'],
            'itens.*.quantidade' => ['required', 'numeric', 'gt:0'],
            'itens.*.preco_unitario' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'itens.required' => 'Adicione pelo menos um item no documento.',
            'itens.*.produto_id.required' => 'Selecione um produto para cada item.',
            'itens.*.quantidade.gt' => 'Quantidade deve ser maior que zero.',
        ];
    }
}
