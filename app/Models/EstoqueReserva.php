<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstoqueReserva extends Model
{
    use HasFactory;

    protected $table = 'estoque_reservas';

    protected $fillable = [
        'documento_item_id',
        'produto_id',
        'quantidade_reservada',
        'status',
        'data_reserva',
        'data_consumo',
    ];

    protected $casts = [
        'quantidade_reservada' => 'decimal:3',
        'data_reserva' => 'datetime',
        'data_consumo' => 'datetime',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(DocumentoItem::class, 'documento_item_id');
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
