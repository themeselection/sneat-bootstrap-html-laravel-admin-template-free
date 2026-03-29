<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompraItem extends Model
{
    use HasFactory;

    protected $table = 'compra_itens';

    protected $fillable = [
        'compra_id',
        'sequencia',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'subtotal',
        'numero_lote',
        'data_validade',
    ];

    protected $casts = [
        'quantidade' => 'decimal:3',
        'preco_unitario' => 'decimal:4',
        'subtotal' => 'decimal:2',
        'data_validade' => 'date',
    ];

    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
