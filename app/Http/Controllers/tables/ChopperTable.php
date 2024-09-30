<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use App\Models\Chopper;
use Illuminate\Http\Request;

class ChopperTable extends Controller
{
  public function index(Request $request)
  {
    $plantGroup = $request->query('plantGroup');

    $choppers = Chopper::query()
      ->when($plantGroup, function ($query, $plantGroup) {
        return $query->where('PlantGroup', $plantGroup);
      })
      ->get();

    $plantGroups = Chopper::query()
      ->select('PlantGroup')
      ->distinct()
      ->get();

    return view(
      'content.tables.table-chopper',
      compact('choppers', 'plantGroups')
    );
  }
}
