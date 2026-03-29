<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TabelaPreco extends Model
{
    use HasFactory;

    protected $table = 'tabelas_preco';

    protected $fillable = [
        'nome',
        'codigo',
        'tipo',
        'ativo',
        'prioridade',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'prioridade' => 'integer',
    ];

    public function produtoPrecos(): HasMany
    {
        return $this->hasMany(ProdutoPreco::class, 'tabela_preco_id');
    }
}
