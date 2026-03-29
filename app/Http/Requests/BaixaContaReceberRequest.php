<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaixaContaReceberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'valor' => ['required', 'numeric', 'gt:0'],
            'data_movimento' => ['required', 'date'],
            'forma_pagamento' => ['nullable', 'string', 'max:50'],
            'observacao' => ['nullable', 'string', 'max:500'],
        ];
    }
}
