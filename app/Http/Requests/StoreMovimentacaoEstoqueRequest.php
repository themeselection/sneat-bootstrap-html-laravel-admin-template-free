<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovimentacaoEstoqueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'tipo' => strtoupper((string) $this->input('tipo')),
            'origem' => trim((string) $this->input('origem')),
            'documento_ref' => trim((string) $this->input('documento_ref')),
            'lote' => trim((string) $this->input('lote')),
            'serial' => trim((string) $this->input('serial')),
            'ajuste_direcao' => strtoupper((string) $this->input('ajuste_direcao')),
        ]);
    }

    public function rules(): array
    {
        return [
            'produto_id' => ['required', Rule::exists('produtos', 'id')],
            'tipo' => ['required', Rule::in(['ENTRADA', 'SAIDA', 'AJUSTE'])],
            'origem' => ['required', 'string', 'max:40'],
            'documento_ref' => ['nullable', 'string', 'max:80'],
            'quantidade' => ['required', 'numeric', 'gt:0'],
            'lote' => ['nullable', 'string', 'max:80'],
            'serial' => ['nullable', 'string', 'max:120'],
            'validade' => ['nullable', 'date'],
            'custo_unitario' => ['nullable', 'numeric', 'min:0'],
            'observacao' => ['nullable', 'string'],
            'ajuste_direcao' => ['nullable', Rule::in(['ENTRADA', 'SAIDA'])],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->input('tipo') === 'AJUSTE' && !$this->input('ajuste_direcao')) {
                $validator->errors()->add('ajuste_direcao', 'Informe a direcao do ajuste.');
            }
        });
    }
}
