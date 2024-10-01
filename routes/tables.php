<?php

use App\Http\Controllers\tables\BajakController;
use App\Http\Controllers\tables\Basic;
use App\Http\Controllers\tables\ChopperTable;
use App\Http\Controllers\tables\SubsoiController;
use App\Http\Controllers\tables\SubsoilController;
use Illuminate\Support\Facades\Route;

Route::get('/tables/basic', [Basic::class, 'index'])->name('tables-basic');
Route::get('/tables/chopper', [ChopperTable::class, 'index'])->name('tables-chopper');

// route untuk menampilkan halaman detail dan edit chopper
Route::get('/tables/chopper/{chopper}/show', [ChopperTable::class, 'show'])->name('tables-chopper.show');
// route untuk mengirimkan data form edit chopper
Route::put('/tables/chopper/{chopper}/detail', [ChopperTable::class, 'update'])->name('tables-chopper.update');
// route untuk menghapus chopper
Route::delete('/tables/chopper/{chopper}', [ChopperTable::class, 'destroy'])->name('tables-chopper.destroy');

Route::get('/tables/bajak', [BajakController::class, 'index'])->name('tables-bajak');
Route::get('/tables/subsoil', [SubsoilController::class, 'index'])->name('tables-subsoil');
