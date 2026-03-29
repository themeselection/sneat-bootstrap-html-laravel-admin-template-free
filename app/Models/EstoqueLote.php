<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstoqueLote extends Model
{
    use HasFactory;

    protected $table = 'estoque_lotes';

    protected $fillable = [
        'produto_id',
        'lote',
        'serial',
        'validade',
        'quantidade_disponivel',
        'custo_unitario',
    ];

    protected $casts = [
        'validade' => 'date',
        'quantidade_disponivel' => 'decimal:3',
        'custo_unitario' => 'decimal:4',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function movimentacoes(): HasMany
    {
        return $this->hasMany(EstoqueMovimentacao::class, 'estoque_lote_id');
    }
}
