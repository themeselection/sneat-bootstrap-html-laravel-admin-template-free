<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoComercial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'documentos_comerciais';

    protected $fillable = [
        'numero',
        'tipo',
        'status',
        'documento_origem_id',
        'cliente_id',
        'vendedor_id',
        'operador_id',
        'filial_id',
        'tabela_preco_id',
        'data_emissao',
        'validade_orcamento',
        'subtotal',
        'desconto_total',
        'acrescimo_total',
        'impostos_total',
        'total_liquido',
        'observacoes',
    ];

    protected $casts = [
        'data_emissao' => 'datetime',
        'validade_orcamento' => 'date',
        'subtotal' => 'decimal:2',
        'desconto_total' => 'decimal:2',
        'acrescimo_total' => 'decimal:2',
        'impostos_total' => 'decimal:2',
        'total_liquido' => 'decimal:2',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }

    public function operador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operador_id');
    }

    public function filial(): BelongsTo
    {
        return $this->belongsTo(Filial::class, 'filial_id');
    }

    public function tabelaPreco(): BelongsTo
    {
        return $this->belongsTo(TabelaPreco::class, 'tabela_preco_id');
    }

    public function origem(): BelongsTo
    {
        return $this->belongsTo(self::class, 'documento_origem_id');
    }

    public function derivados(): HasMany
    {
        return $this->hasMany(self::class, 'documento_origem_id');
    }

    public function itens(): HasMany
    {
        return $this->hasMany(DocumentoItem::class, 'documento_id')->orderBy('sequencia');
    }

    public function eventos(): HasMany
    {
        return $this->hasMany(DocumentoEvento::class, 'documento_id')->orderByDesc('data_evento');
    }

    public function pagamentos(): HasMany
    {
        return $this->hasMany(DocumentoPagamento::class, 'documento_id');
    }

    public function faturamento(): HasOne
    {
        return $this->hasOne(Faturamento::class, 'documento_id');
    }

    public function contaReceber(): HasOne
    {
        return $this->hasOne(ContaReceber::class, 'documento_id');
    }
}
