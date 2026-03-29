<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnidadeMedida extends Model
{
    use HasFactory;

    protected $table = 'unidades_medida';

    protected $fillable = [
        'sigla',
        'nome',
        'casas_decimais',
        'ativo',
    ];

    protected $casts = [
        'casas_decimais' => 'integer',
        'ativo' => 'boolean',
    ];

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class, 'unidade_principal_id');
    }
}
