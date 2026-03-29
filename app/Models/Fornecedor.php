<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fornecedores';

    protected $fillable = [
        'nome',
        'cnpj',
        'telefone',
        'email',
        'endereco',
        'contato',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class, 'fornecedor_id');
    }
}
