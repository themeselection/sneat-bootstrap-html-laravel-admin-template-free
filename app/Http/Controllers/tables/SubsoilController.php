<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use App\Models\Subsoil;
use Illuminate\Http\Request;

class SubsoilController extends Controller
{
    public function index(Request $request)
    {
        $plantGroup = $request->query('plantGroup');

        $subsoils = Subsoil::query()
            ->when($plantGroup, function ($query, $plantGroup) {
                return $query->where('PlantGroup', $plantGroup);
            })
            ->get();

        $plantGroups = Subsoil::query()
            ->select('PlantGroup')
            ->distinct()
            ->get();

        return view(
            'content.tables.table-subsoil',
            compact('subsoils', 'plantGroups')
        );
    }
}
