<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chopper extends Model
{
  use HasFactory;

  protected $table = 'chopper';

  protected $fillable = [
    'PlantGroup',
    'TanggalPengamatan',
    'Lokasi',
    'LuasAktif',
    'Sat',
    'ExsTanaman',
    '% Tanaman Hancur',
    '% Bonggol Tercacah',
    '% Aplikasi Rapat',
    'Total (%)',
  ];
}
