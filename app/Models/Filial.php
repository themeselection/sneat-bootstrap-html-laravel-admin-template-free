<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    use HasFactory;

    protected $table = 'filiais';

    protected $fillable = [
        'nome',
        'codigo',
        'ativa',
    ];

    protected $casts = [
        'ativa' => 'boolean',
    ];
}
