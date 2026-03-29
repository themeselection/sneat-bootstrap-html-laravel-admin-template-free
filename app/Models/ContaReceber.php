<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContaReceber extends Model
{
    use HasFactory;

    protected $table = 'contas_receber';

    protected $fillable = [
        'documento_id',
        'cliente_id',
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

    public function documento(): BelongsTo
    {
        return $this->belongsTo(DocumentoComercial::class, 'documento_id');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function movimentos(): HasMany
    {
        return $this->hasMany(ContaReceberMovimento::class, 'conta_receber_id')->orderByDesc('data_movimento');
    }
}
