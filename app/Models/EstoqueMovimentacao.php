<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstoqueMovimentacao extends Model
{
    use HasFactory;

    protected $table = 'estoque_movimentacoes';

    public $timestamps = false;

    protected $fillable = [
        'produto_id',
        'estoque_lote_id',
        'estoque_reserva_id',
        'tipo',
        'origem',
        'origem_tipo',
        'origem_id',
        'documento_ref',
        'quantidade',
        'sinal',
        'saldo_apos',
        'observacao',
        'user_id',
        'created_at',
    ];

    protected $casts = [
        'quantidade' => 'decimal:3',
        'saldo_apos' => 'decimal:3',
        'created_at' => 'datetime',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function lote(): BelongsTo
    {
        return $this->belongsTo(EstoqueLote::class, 'estoque_lote_id');
    }

    public function reserva(): BelongsTo
    {
        return $this->belongsTo(EstoqueReserva::class, 'estoque_reserva_id');
    }
}
