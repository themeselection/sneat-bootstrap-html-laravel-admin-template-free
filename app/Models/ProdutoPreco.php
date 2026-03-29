<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdutoPreco extends Model
{
    use HasFactory;

    protected $table = 'produto_precos';

    protected $fillable = [
        'produto_id',
        'tabela_preco_id',
        'preco',
        'custo_referencia',
        'margem_percentual',
        'vigencia_inicio',
        'vigencia_fim',
        'ativo',
    ];

    protected $casts = [
        'preco' => 'decimal:4',
        'custo_referencia' => 'decimal:4',
        'margem_percentual' => 'decimal:4',
        'vigencia_inicio' => 'datetime',
        'vigencia_fim' => 'datetime',
        'ativo' => 'boolean',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function tabelaPreco(): BelongsTo
    {
        return $this->belongsTo(TabelaPreco::class, 'tabela_preco_id');
    }
}
