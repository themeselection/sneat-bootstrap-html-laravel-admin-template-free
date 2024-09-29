<?php

namespace App\Http\Controllers\user_interface;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Buttons extends Controller
{
  public function index()
  {
    return view('content.user-interface.ui-buttons');
  }
}
