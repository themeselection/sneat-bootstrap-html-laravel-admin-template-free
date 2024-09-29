<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use App\Models\Bajak;
use Illuminate\Http\Request;

class BajakController extends Controller
{
  public function index(Request $request)
  {
    $plantGroup = $request->query('plantGroup');

    $bajaks = Bajak::query()
      ->when($plantGroup, function ($query, $plantGroup) {
        return $query->where('PlantGroup', $plantGroup);
      })
      ->get();

    $plantGroups = Bajak::query()
      ->select('PlantGroup')
      ->distinct()
      ->get();

    return view(
      'content.tables.table-bajak',
      compact('bajaks', 'plantGroups')
    );
  }
}
