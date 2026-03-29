<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContaPagarMovimento extends Model
{
    use HasFactory;

    protected $table = 'contas_pagar_movimentos';

    protected $fillable = [
        'conta_pagar_id',
        'usuario_id',
        'tipo',
        'valor',
        'data_movimento',
        'forma_pagamento',
        'observacao',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'data_movimento' => 'datetime',
    ];

    public function contaPagar(): BelongsTo
    {
        return $this->belongsTo(ContaPagar::class, 'conta_pagar_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}

