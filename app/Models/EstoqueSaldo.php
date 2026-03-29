<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstoqueSaldo extends Model
{
    use HasFactory;

    protected $table = 'estoque_saldos';

    public $timestamps = false;

    protected $fillable = [
        'produto_id',
        'quantidade_atual',
        'quantidade_reservada',
        'estoque_minimo',
        'updated_at',
    ];

    protected $casts = [
        'quantidade_atual' => 'decimal:3',
        'quantidade_reservada' => 'decimal:3',
        'estoque_minimo' => 'decimal:3',
        'updated_at' => 'datetime',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
