<?php

namespace App\Http\Controllers\user_interface;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Accordion extends Controller
{
  public function index()
  {
    return view('content.user-interface.ui-accordion');
  }
}
