<?php

use App\Http\Controllers\Voucher\GetVoucherController;
use App\Http\Controllers\Voucher\GetByIdVoucherController;
use App\Http\Controllers\Voucher\StoreVoucherController;
use App\Http\Controllers\Voucher\UpdateVoucherController;
use App\Http\Controllers\Voucher\DeleteVoucherController;
use App\Http\Controllers\Voucher\StoreReservaDesdeVoucherController;

Route::group(['prefix' => 'vouchers', 'middleware' => 'auth:empleado'], function () {
    Route::get('/', GetVoucherController::class);
    Route::get('/{id}', GetByIdVoucherController::class);
    Route::post('/', StoreVoucherController::class);
    Route::post('/crear-reserva', StoreReservaDesdeVoucherController::class);
    Route::put('/{id}', UpdateVoucherController::class);
    Route::delete('/{id}', DeleteVoucherController::class);
});