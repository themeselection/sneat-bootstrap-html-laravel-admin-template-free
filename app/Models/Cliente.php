<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'tipo_pessoa',
        'nome',
        'nome_fantasia',
        'cpf_cnpj',
        'rg_ie',
        'email',
        'telefone',
        'celular',
        'contato_nome',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'codigo_ibge',
        'pais',
        'data_nascimento_fundacao',
        'sexo',
        'observacoes',
        'ativo',
        'saldo_credito',
        'limite_prazo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'saldo_credito' => 'decimal:2',
        'limite_prazo' => 'decimal:2',
        'data_nascimento_fundacao' => 'date',
    ];

    public function getDocumentoFormatadoAttribute(): string
    {
        $digits = preg_replace('/\D/', '', (string) $this->cpf_cnpj);

        if (strlen($digits) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $digits);
        }

        if (strlen($digits) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3\/$4-$5', $digits);
        }

        return (string) $this->cpf_cnpj;
    }
}
