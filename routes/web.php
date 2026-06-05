<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return view('index');
});

Route::middleware('auth')->group(function () {
    Route::resource('perfiles', PerfilesController::class);
    Route::resource('clientes', ClientesController::class);
    Route::get('facturas/reporte/pdf', [PdfController::class, 'facturas'])
        ->name('facturas.reporte');
    Route::resource('facturas', FacturasController::class)
        ->only(['index', 'show']);
    Route::resource('facturas', FacturasController::class)
        ->except(['index', 'show'])
        ->middleware('admin');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
