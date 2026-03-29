<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sku',
        'nome',
        'descricao',
        'codigo_barras',
        'categoria_id',
        'unidade_principal_id',
        'controla_lote',
        'controla_validade',
        'ativo',
        'permite_venda',
        'permite_compra',
        'ncm',
        'cest',
        'marca',
        'observacoes',
    ];

    protected $casts = [
        'controla_lote' => 'boolean',
        'controla_validade' => 'boolean',
        'ativo' => 'boolean',
        'permite_venda' => 'boolean',
        'permite_compra' => 'boolean',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaProduto::class, 'categoria_id');
    }

    public function unidadePrincipal(): BelongsTo
    {
        return $this->belongsTo(UnidadeMedida::class, 'unidade_principal_id');
    }

    public function unidades(): HasMany
    {
        return $this->hasMany(ProdutoUnidade::class, 'produto_id');
    }

    public function estoqueSaldo(): HasOne
    {
        return $this->hasOne(EstoqueSaldo::class, 'produto_id');
    }

    public function movimentosEstoque(): HasMany
    {
        return $this->hasMany(EstoqueMovimentacao::class, 'produto_id');
    }

    public function precos(): HasMany
    {
        return $this->hasMany(ProdutoPreco::class, 'produto_id');
    }

    public function documentoItens(): HasMany
    {
        return $this->hasMany(DocumentoItem::class, 'produto_id');
    }
}
