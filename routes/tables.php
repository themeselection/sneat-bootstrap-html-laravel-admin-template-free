<?php

use App\Http\Controllers\tables\BajakController;
use App\Http\Controllers\tables\Basic;
use App\Http\Controllers\tables\ChopperTable;
use App\Http\Controllers\tables\SubsoiController;
use App\Http\Controllers\tables\SubsoilController;
use Illuminate\Support\Facades\Route;

Route::get('/tables/basic', [Basic::class, 'index'])->name('tables-basic');
Route::get('/tables/chopper', [ChopperTable::class, 'index'])->name('tables-chopper');
Route::get('/tables/bajak', [BajakController::class, 'index'])->name('tables-bajak');
<<<<<<< HEAD
Route::get('/tables/subsoil', [SubsoilController::class, 'index'])->name('tables-subsoil');
=======

// hmm
>>>>>>> 897cac00502908ae7bee8210741cda4f9ee9e9b4
