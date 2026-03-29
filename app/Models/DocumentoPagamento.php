<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentoPagamento extends Model
{
    use HasFactory;

    protected $table = 'documento_pagamentos';

    protected $fillable = [
        'documento_id',
        'forma_pagamento',
        'valor',
        'parcelas',
        'autorizacao',
        'status',
        'data_pagamento',
        'metadata',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'data_pagamento' => 'datetime',
        'metadata' => 'array',
    ];

    public function documento(): BelongsTo
    {
        return $this->belongsTo(DocumentoComercial::class, 'documento_id');
    }
}
