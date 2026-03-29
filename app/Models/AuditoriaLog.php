<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditoriaLog extends Model
{
    use HasFactory;

    protected $table = 'auditoria_logs';

    protected $fillable = [
        'usuario_id',
        'acao',
        'entidade_tipo',
        'entidade_id',
        'dados_antes',
        'dados_depois',
        'ip',
        'user_agent',
    ];

    protected $casts = [
        'dados_antes' => 'array',
        'dados_depois' => 'array',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
