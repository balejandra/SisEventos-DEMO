<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('error', function (){
    return view('auth.error'); //seccion de validacion de autehticación de usuario
})->name('error');

Route::middleware(['auth' , 'verified'])->group(function () {
//seccion para incorporación de rutas por módulo
});
