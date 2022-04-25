<?php

namespace App\Http\Controllers\form_validation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Validation extends Controller
{
  public function index()
  {
    return view('content.form-validation.form-validation');
  }
}
