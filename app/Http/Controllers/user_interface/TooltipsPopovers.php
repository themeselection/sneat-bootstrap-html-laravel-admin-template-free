<?php

namespace App\Http\Controllers\user_interface;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TooltipsPopovers extends Controller
{
  public function index()
  {
    return view('content.user-interface.ui-tooltips-popovers');
  }
}
