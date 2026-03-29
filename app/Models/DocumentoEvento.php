<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentoEvento extends Model
{
    use HasFactory;

    protected $table = 'documento_eventos';

    protected $fillable = [
        'documento_id',
        'status_anterior',
        'status_novo',
        'acao',
        'usuario_id',
        'data_evento',
        'detalhes',
    ];

    protected $casts = [
        'data_evento' => 'datetime',
        'detalhes' => 'array',
    ];

    public function documento(): BelongsTo
    {
        return $this->belongsTo(DocumentoComercial::class, 'documento_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
