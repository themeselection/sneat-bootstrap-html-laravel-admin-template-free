<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContaReceberMovimento extends Model
{
    use HasFactory;

    protected $table = 'contas_receber_movimentos';

    protected $fillable = [
        'conta_receber_id',
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

    public function contaReceber(): BelongsTo
    {
        return $this->belongsTo(ContaReceber::class, 'conta_receber_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
