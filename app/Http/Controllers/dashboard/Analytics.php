<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bajak;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {

    $plantGroups = Bajak::query()
      ->select('PlantGroup')
      ->distinct()
      ->get();

    $bajakTotalPersentase = [];

    foreach ($plantGroups as $plantGroup) {
      $bajakTotalPersentase[$plantGroup->PlantGroup] = Bajak::query()
        ->where('PlantGroup', $plantGroup->PlantGroup)
        ->avg('Total(%)') ?? 0;
    }
    return view('content.dashboard.dashboards-analytics', compact('bajakTotalPersentase'));
  }
}
