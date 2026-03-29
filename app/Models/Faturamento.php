<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faturamento extends Model
{
    use HasFactory;

    protected $table = 'faturamentos';

    protected $fillable = [
        'documento_id',
        'numero_fiscal',
        'chave_acesso',
        'status_fiscal',
        'xml_path',
        'pdf_path',
        'data_faturamento',
        'erro_fiscal',
    ];

    protected $casts = [
        'data_faturamento' => 'datetime',
    ];

    public function documento(): BelongsTo
    {
        return $this->belongsTo(DocumentoComercial::class, 'documento_id');
    }
}
