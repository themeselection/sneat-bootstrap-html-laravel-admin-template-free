<?php

namespace App\Http\Controllers\icons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Boxicons extends Controller
{
  public function index()
  {
    return view('content.icons.icons-boxicons');
  }
}
