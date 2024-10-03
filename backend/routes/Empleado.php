<?php

use App\Http\Controllers\Empleado\GetEmpleadoController;
use App\Http\Controllers\Empleado\GetByIdEmpleadoController;
use App\Http\Controllers\Empleado\StoreEmpleadoController;
use App\Http\Controllers\Empleado\UpdateEmpleadoController;
use App\Http\Controllers\Empleado\DeleteEmpleadoController;

Route::group(['prefix' => 'empleados', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetEmpleadoController::class);
    Route::get('/{id}', GetByIdEmpleadoController::class);
    Route::post('/', StoreEmpleadoController::class);
    Route::put('/{id}', UpdateEmpleadoController::class);
    Route::delete('/{id}', DeleteEmpleadoController::class);
});