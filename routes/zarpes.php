<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('error', function (){
    return view('errors.error_rol_inex'); //seccion de validacion de autehticación de usuario
})->name('error');

Route::middleware(['auth' , 'verified'])->group(function () {
//seccion para incorporación de rutas por módulo



    //-------------------------------------------------------------



    Route::resource('tablaMandos', \App\Http\Controllers\Zarpes\TablaMandoController::class);


    Route::get('/zarpes/permisosDeZarpe', function () {
        return view('zarpes.PermisoDeZarpe.index');
    });

    Route::get('/zarpes/permisosDeZarpe/create', function () {
        return view('zarpes.PermisoDeZarpe.index');
    });
    Route::get('validationStepTwo',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'validationStepTwo'])->name('validationStepTwo');
     Route::get('validationStepTwoE',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'validationStepTwoE'])->name('validationStepTwoE');

    Route::resource('permisosestadia', \App\Http\Controllers\Zarpes\PermisoEstadiaController::class);

    Route::resource('permisosestadiarenovacion', \App\Http\Controllers\Zarpes\PermisoEstadiaRenovacionController::class);


    Route::get('updateStatus/{id}/{status}', [\App\Http\Controllers\Zarpes\PermisoEstadiaController::class,'updateStatus'])->name('statusEstadia');
    Route::get('/permisoestadiapdf/{id}',[\App\Http\Controllers\Zarpes\PdfGeneratorController::class,'imprimirEstadia'])->name('estadiapdf');
    Route::get('/permisosestadiarenovacion.create/{id}',[\App\Http\Controllers\Zarpes\PermisoEstadiaRenovacionController::class,'create'])->name('createrenovacion');
    Route::match(['put', 'patch'],'permisosestadiarenovacion.store/{id}', [\App\Http\Controllers\Zarpes\PermisoEstadiaRenovacionController::class,'store'])->name('storerenovacion');

    //Route::resource('permisoszarpes', \App\Http\Controllers\Zarpes\PermisoZarpeController::class);
    Route::get('updateStatus/{id}/{status}/{capitania}', [\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'updateStatus'])->name('status');
    Route::get('/permisozarpepdf/{id}',[\App\Http\Controllers\Zarpes\PdfGeneratorController::class,'imprimir'])->name('zarpepdf');

    Route::get('/zarpes/permisoszarpes', [App\Http\Controllers\Zarpes\PermisoZarpeController::class, 'index'])->name('permisoszarpes.index')->middleware('auth');

    Route::get('/zarpes/permisoszarpes/createStepOne', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepOne'])->name('permisoszarpes.createStepOne');

    Route::post('permisoszarpes/createStepOne', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateStepOne'])->name('permisoszarpes.permissionCreateStepOne');

    Route::get('permisoszarpes/create-step-two', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'CreateStepTwo'])->name('permisoszarpes.CreateStepTwo');

    Route::post('permisoszarpes/create-step-two', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateSteptwo'])->name('permisoszarpes.permissionCreateSteptwo');

    Route::get('permisoszarpes/create-step-twoE', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'CreateStepTwoE'])->name('permisoszarpes.CreateStepTwoE');

    Route::post('permisoszarpes/create-step-twoE', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateSteptwoE'])->name('permisoszarpes.permissionCreateSteptwoE');

    Route::get('permisoszarpes/create-step-three', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepThree'])->name('permisoszarpes.createStepThree');

    Route::post('permisoszarpes/create-step-three', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateStepThree'])->name('permisoszarpes.permissionCreateStepThree');

    Route::get('permisoszarpes/create-step-four', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepFour'])->name('permisoszarpes.createStepFour');

    Route::post('permisoszarpes/create-step-four', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateStepFour'])->name('permisoszarpes.permissionCreateStepFour');

    Route::get('permisoszarpes/create-step-five', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepFive'])->name('permisoszarpes.createStepFive');

    Route::post('permisoszarpes/create-step-five', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateStepFive'])->name('permisoszarpes.permissionCreateStepFive');

    Route::get('permisoszarpes/create-step-six', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepSix'])->name('permisoszarpes.createStepSix');

    Route::post('permisoszarpes/create-step-six', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'permissionCreateStepSix'])->name('permisoszarpes.permissionCreateStepSix');

    Route::get('permisoszarpes/create-step-seven', [App\Http\Controllers\Zarpes\PermisoZarpeController::class,'createStepSeven'])->name('permisoszarpes.createStepSeven');

    Route::post('permisoszarpes/create-step-seven', [App\Http\Controllers\Zarpes\PermisoZarpeController::class, 'store'])->name('permisoszarpes.store');

     Route::get('permisoszarpes/{permisoszarpe}', [App\Http\Controllers\Zarpes\PermisoZarpeController::class, 'show'])->name('permisoszarpes.show');


    Route::get('consultasaime2',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'consulta2'])->name('consultasaime2');

    Route::get('validarMarino',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'validarMarino'])->name('validarMarino');

    Route::get('validacionMarino',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'validacionMarino'])->name('validacionMarino');

    Route::get('marinoExtranjero',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'marinoExtranjero'])->name('marinoExtranjero');

    Route::get('validacionJerarquizacion',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'validacionJerarquizacion'])->name('validacionJerarquizacion');

    Route::get('BuscaEstablecimientosNauticos',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'BuscaEstablecimientosNauticos'])->name('BuscaEstablecimientosNauticos');

    Route::resource('status', \App\Http\Controllers\Zarpes\StatusController::class);

    Route::resource('equipos', \App\Http\Controllers\Zarpes\EquipoController::class);

    Route::get('FindCapitania',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'FindCapitania'])->name('FindCapitania');

    Route::get('deleteTripulante',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'deleteTripulante'])->name('deleteTripulante');

    Route::get('deletePassenger',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'deletePassenger'])->name('deletePassenger');

    Route::get('AddPassenger',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'AddPassenger'])->name('AddPassenger');

    Route::post('AddDocumentos',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'AddDocumentos'])->name('AddDocumentos');

    Route::post('AddDocumentosMarinosZN',[\App\Http\Controllers\Zarpes\PermisoZarpeController::class,'AddDocumentosMarinosZN'])->name('AddDocumentosMarinosZN');

    /*Inicio de Rutas de zarpe Internacional*/

    Route::get('/zarpes/zarpeInternacional', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class, 'index'])->name('zarpeInternacional.index')->middleware('auth');

    Route::get('/zarpes/zarpeInternacional/createStepOne', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'createStepOne'])->name('zarpeInternacional.createStepOne');

    Route::post('zarpeInternacional/createStepOne', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'permissionCreateStepOne'])->name('zarpeInternacional.permissionCreateStepOne');

    Route::get('zarpeInternacional/create-step-two', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'CreateStepTwo'])->name('zarpeInternacional.CreateStepTwo');

    Route::post('zarpeInternacional/create-step-two', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'permissionCreateSteptwo'])->name('zarpeInternacional.permissionCreateSteptwo');

    Route::get('zarpeInternacional/create-step-twoE', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'CreateStepTwoE'])->name('zarpeInternacional.CreateStepTwoE');

    Route::post('zarpeInternacional/create-step-twoE', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'permissionCreateSteptwoE'])->name('zarpeInternacional.permissionCreateSteptwoE');

    Route::get('zarpeInternacional/create-step-three', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'createStepThree'])->name('zarpeInternacional.createStepThree');

    Route::post('zarpeInternacional/create-step-three', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'permissionCreateStepThree'])->name('zarpeInternacional.permissionCreateStepThree');

    Route::get('zarpeInternacional/create-step-four', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'createStepFour'])->name('zarpeInternacional.createStepFour');

    Route::post('zarpeInternacional/create-step-four', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'permissionCreateStepFour'])->name('zarpeInternacional.permissionCreateStepFour');

    Route::get('zarpeInternacional/create-step-five', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'createStepFive'])->name('zarpeInternacional.createStepFive');

    Route::post('zarpeInternacional/create-step-five', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'permissionCreateStepFive'])->name('zarpeInternacional.permissionCreateStepFive');

    Route::get('zarpeInternacional/create-step-six', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'createStepSix'])->name('zarpeInternacional.createStepSix');

    Route::post('zarpeInternacional/create-step-six', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'permissionCreateStepSix'])->name('zarpeInternacional.permissionCreateStepSix');

    Route::get('zarpeInternacional/create-step-seven', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'createStepSeven'])->name('zarpeInternacional.createStepSeven');

    Route::post('zarpeInternacional/create-step-seven', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class, 'store'])->name('zarpeInternacional.store');

     Route::get('zarpeInternacional/{permisoszarpe}', [App\Http\Controllers\Zarpes\ZarpeInternacionalController::class, 'show'])->name('zarpeInternacional.show');

     Route::get('update/{id}/{status}/{capitania}', [\App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'updateStatus'])->name('statusInt');
     Route::get('/permisozarpeIntpdf/{id}',[\App\Http\Controllers\Zarpes\PdfGeneratorController::class,'imprimirInternacional'])->name('zarpeInternacionalpdf');

     Route::get('validacionMarinoZI',[\App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'validacionMarinoZI'])->name('validacionMarinoZI');

     Route::get('marinoExtranjeroZI',[\App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'marinoExtranjeroZI'])->name('marinoExtranjeroZI');

     Route::get('deleteTripulanteZI',[\App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'deleteTripulanteZI'])->name('deleteTripulanteZI');

     Route::post('AddDocumentosMarinosZI',[\App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'AddDocumentosMarinosZI'])->name('AddDocumentosMarinosZI');

     Route::get('AddPassengerZI',[\App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'AddPassengerZI'])->name('AddPassengerZI');

    Route::post('AddDocumentosZI',[\App\Http\Controllers\Zarpes\ZarpeInternacionalController::class,'AddDocumentosZI'])->name('AddDocumentosZI');


    /*Fin de Rutas de zarpe Internacional*/

    Route::get('notificaciones/index',[\App\Http\Controllers\Zarpes\NotificacioneController::class,'index'])->name('notificaciones.index');

    Route::get('notificaciones/show/{notificacion}',[\App\Http\Controllers\Zarpes\NotificacioneController::class,'show'])->name('notificaciones.show');


});
