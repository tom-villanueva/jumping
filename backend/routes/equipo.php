<?php

use App\Http\Controllers\Equipo\GetEquiposController;
use App\Http\Controllers\Equipo\GetEquipoByIdController;
use App\Http\Controllers\Equipo\StoreEquipoController;
use App\Http\Controllers\Equipo\UpdateEquipoController;
use App\Http\Controllers\Equipo\DeleteEquipoController;
use App\Http\Controllers\Equipo\UpdateEquipoThumbnailController;
use App\Http\Controllers\EquipoDescuento\DeleteEquipoDescuentoController;
use App\Http\Controllers\EquipoDescuento\StoreEquipoDescuentoController;
use App\Http\Controllers\EquipoDescuento\UpdateEquipoDescuentoController;

Route::group(['prefix' => 'equipos'], function () {
    Route::get('/', GetEquiposController::class);
    Route::get('/{id}', GetEquipoByIdController::class);
    Route::post('/', StoreEquipoController::class);
    Route::put('/{id}', UpdateEquipoController::class);
    Route::delete('/{id}', DeleteEquipoController::class);
    // Thumbnail
    Route::post('/{id}/upload-thumbnail', UpdateEquipoThumbnailController::class);
    // Descuentos
    Route::post('/descuentos', StoreEquipoDescuentoController::class);
    Route::put('/descuentos/{equipo_descuento_id}', UpdateEquipoDescuentoController::class);
    Route::delete('/descuentos/{equipo_descuento_id}', DeleteEquipoDescuentoController::class);
});