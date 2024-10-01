<?php

use App\Http\Controllers\tables\BajakController;
use App\Http\Controllers\tables\Basic;
use App\Http\Controllers\tables\ChopperTable;
use Illuminate\Support\Facades\Route;

Route::get('/tables/basic', [Basic::class, 'index'])->name('tables-basic');
Route::get('/tables/chopper', [ChopperTable::class, 'index'])->name('tables-chopper');

Route::get('/tables/bajak', [BajakController::class, 'index'])->name('tables-bajak');

// hmm
