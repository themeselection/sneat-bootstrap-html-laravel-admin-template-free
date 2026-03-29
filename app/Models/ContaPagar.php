<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContaPagar extends Model
{
    use HasFactory;

    protected $table = 'contas_pagar';

    protected $fillable = [
        'compra_id',
        'fornecedor_id',
        'valor_original',
        'valor_aberto',
        'vencimento',
        'status',
    ];

    protected $casts = [
        'valor_original' => 'decimal:2',
        'valor_aberto' => 'decimal:2',
        'vencimento' => 'date',
    ];

    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function movimentos(): HasMany
    {
        return $this->hasMany(ContaPagarMovimento::class, 'conta_pagar_id');
    }
}
