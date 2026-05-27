<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FacturasController;

Route::get('/', function () {
    return view('index');
});

Route::resource('perfiles', PerfilesController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('facturas', FacturasController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

