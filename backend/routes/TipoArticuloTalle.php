<?php

use App\Http\Controllers\TipoArticuloTalle\GetTipoArticuloTalleController;

Route::group(['prefix' => 'tipo-articulo-talles', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetTipoArticuloTalleController::class);
});