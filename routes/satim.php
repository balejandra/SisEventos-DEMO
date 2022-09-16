<?php
use Illuminate\Support\Facades\Route;

Route::get('error', function (){
    return view('errors.error_rol_inex'); //seccion de validacion de autehticación de usuario
})->name('error');

Route::middleware(['auth' , 'verified'])->group(function () {
//seccion para incorporación de rutas por módulo
    Route::resource('autorizacionEventos', \App\Http\Controllers\SATIM\AutorizacionEventoController::class);

    Route::get('updateStatus/{id}/{status}', [\App\Http\Controllers\SATIM\AutorizacionEventoController::class,'updateStatus'])->name('updateStatus');


});
