<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\pagoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('empleados', EmpleadoController::class);
    Route::get('/empleados/{id}/ficha', [EmpleadoController::class, 'ficha'])->name('empleados.ficha');
    
    Route::resource('contratos', ContratoController::class);
    Route::resource('pagos', PagoController::class);
    Route::get('pagos/create', [PagoController::class, 'create'])->name('pagos.create');
    Route::post('pagos', [PagoController::class, 'store'])->name('pagos.store');
});

require __DIR__.'/auth.php';
