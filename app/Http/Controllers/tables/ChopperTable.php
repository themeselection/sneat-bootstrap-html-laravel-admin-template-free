<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use App\Models\Chopper;
use Illuminate\Http\Request;

class ChopperTable extends Controller
{
  public function index()
  {

    $choppers = Chopper::all();

    return view('content.tables.table-chopper', compact('choppers'));
  }
}
