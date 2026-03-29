<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DocumentoItem extends Model
{
    use HasFactory;

    protected $table = 'documento_itens';

    protected $fillable = [
        'documento_id',
        'sequencia',
        'produto_id',
        'descricao',
        'unidade_sigla',
        'quantidade',
        'preco_tabela',
        'preco_unitario',
        'subtotal_bruto',
        'subtotal_liquido',
        'metadata',
    ];

    protected $casts = [
        'quantidade' => 'decimal:3',
        'preco_tabela' => 'decimal:4',
        'preco_unitario' => 'decimal:4',
        'subtotal_bruto' => 'decimal:2',
        'subtotal_liquido' => 'decimal:2',
        'metadata' => 'array',
    ];

    public function documento(): BelongsTo
    {
        return $this->belongsTo(DocumentoComercial::class, 'documento_id');
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function reserva(): HasOne
    {
        return $this->hasOne(EstoqueReserva::class, 'documento_item_id');
    }
}
