<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';

    protected $fillable = [
        'numero',
        'fornecedor_id',
        'usuario_id',
        'filial_id',
        'data_compra',
        'status',
        'valor_total',
        'observacoes',
    ];

    protected $casts = [
        'data_compra' => 'datetime',
        'valor_total' => 'decimal:2',
    ];

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function filial(): BelongsTo
    {
        return $this->belongsTo(Filial::class, 'filial_id');
    }

    public function itens(): HasMany
    {
        return $this->hasMany(CompraItem::class, 'compra_id')->orderBy('sequencia');
    }

    public function contaPagar(): HasOne
    {
        return $this->hasOne(ContaPagar::class, 'compra_id');
    }
}
