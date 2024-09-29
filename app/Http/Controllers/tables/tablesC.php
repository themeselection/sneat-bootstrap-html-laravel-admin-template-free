<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\tables;


class tablesC extends Controller
{
    public function index()
    {
        $data_chopper = tables::all();
        return view('pageview.tablesT', compact('data_chopper'));
    }
}
