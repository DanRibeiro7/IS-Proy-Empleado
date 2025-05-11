<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\pagoController;
use App\Http\Controllers\BoletaPagoController;

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
    Route::resource('areas', AreaController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::get('/empleados/{id}/ficha', [EmpleadoController::class, 'ficha'])->name('empleados.fichaemp');
    
    Route::get('/empleado/pdf/{id}', [EmpleadoController::class, 'generarPdf'])->name('empleado.pdf');

    Route::resource('contratos', ContratoController::class);
    Route::resource('pagos', PagoController::class);
    Route::get('pagos/create', [PagoController::class, 'create'])->name('pagos.create');
    Route::post('pagos', [PagoController::class, 'store'])->name('pagos.store');
    Route::get('pagos/{pago}/edit', [PagoController::class, 'edit'])->name('pagos.edit');
    Route::get('/pagos/{idPago}/boleta', [PagoController::class, 'generatePDF'])->name('pagos.boleta');
    
    Route::get('/contratos/{contrato}/pagos', [App\Http\Controllers\PagoController::class, 'pagosPorContrato'])->name('pagos.porContrato');
    Route::get('/pagos/seleccionar_contrato', [PagoController::class, 'seleccionarContrato'])->name('pagos.seleccionarContrato');
    Route::get('/reportes', [\App\Http\Controllers\ReporteController::class, 'index'])->name('reportes.index');


     
    

});

require __DIR__.'/auth.php';
