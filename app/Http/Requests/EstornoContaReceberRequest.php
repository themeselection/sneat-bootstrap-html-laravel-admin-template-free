<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstornoContaReceberRequest extends FormRequest
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
            'observacao' => ['required', 'string', 'min:5', 'max:500'],
        ];
    }
}
