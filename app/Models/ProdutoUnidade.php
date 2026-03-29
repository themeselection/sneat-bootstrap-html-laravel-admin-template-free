<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdutoUnidade extends Model
{
    use HasFactory;

    protected $table = 'produto_unidades';

    protected $fillable = [
        'produto_id',
        'unidade_id',
        'fator_conversao',
        'codigo_barras',
        'ativo',
    ];

    protected $casts = [
        'fator_conversao' => 'decimal:4',
        'ativo' => 'boolean',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function unidade(): BelongsTo
    {
        return $this->belongsTo(UnidadeMedida::class, 'unidade_id');
    }
}
