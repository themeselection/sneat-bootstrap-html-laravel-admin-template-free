<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProdutoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'sku' => strtoupper(trim((string) $this->input('sku'))),
            'codigo_barras' => $this->input('codigo_barras') ? preg_replace('/\s+/', '', (string) $this->input('codigo_barras')) : null,
            'controla_lote' => $this->boolean('controla_lote', false),
            'controla_validade' => $this->boolean('controla_validade', false),
            'ativo' => $this->boolean('ativo', true),
            'permite_venda' => $this->boolean('permite_venda', true),
            'permite_compra' => $this->boolean('permite_compra', true),
        ]);
    }

    public function rules(): array
    {
        return [
            'sku' => ['required', 'string', 'max:40', 'unique:produtos,sku'],
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'codigo_barras' => ['nullable', 'string', 'max:50', 'unique:produtos,codigo_barras'],
            'categoria_id' => ['required', Rule::exists('categorias_produto', 'id')],
            'unidade_principal_id' => ['required', Rule::exists('unidades_medida', 'id')],
            'marca' => ['nullable', 'string', 'max:120'],
            'ncm' => ['nullable', 'string', 'max:20'],
            'cest' => ['nullable', 'string', 'max:20'],
            'observacoes' => ['nullable', 'string'],
            'controla_lote' => ['sometimes', 'boolean'],
            'controla_validade' => ['sometimes', 'boolean'],
            'ativo' => ['sometimes', 'boolean'],
            'permite_venda' => ['sometimes', 'boolean'],
            'permite_compra' => ['sometimes', 'boolean'],
            'estoque_minimo' => ['required', 'numeric', 'min:0'],
            'preco_custo' => ['required', 'numeric', 'min:0'],
            'preco_venda' => ['required', 'numeric', 'min:0'],
            'tabela_preco_id' => ['required', Rule::exists('tabelas_preco', 'id')],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $precoCusto = (float) $this->input('preco_custo', 0);
            $precoVenda = (float) $this->input('preco_venda', 0);

            if ($precoVenda < $precoCusto) {
                $validator->errors()->add('preco_venda', 'Preco de venda nao pode ser menor que o preco de custo.');
            }
        });
    }
}
