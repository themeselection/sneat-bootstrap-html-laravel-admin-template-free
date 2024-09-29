<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountSettingsConnections extends Controller
{
  public function index()
  {
    return view('content.pages.pages-account-settings-connections');
  }
}
