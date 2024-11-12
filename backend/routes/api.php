<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:empleado'])->get('/empleados/user', function (Request $request) {
    return $request->user();
});

require __DIR__.'/auth.php';
require __DIR__.'/auth_empleados.php';

require __DIR__.'/tipo_articulo.php';
require __DIR__.'/talle.php';
require __DIR__.'/equipo.php';
require __DIR__.'/articulo.php';
require __DIR__.'/descuento.php';
require __DIR__.'/Traslado.php';
require __DIR__.'/Reserva.php';
require __DIR__.'/Estado.php';
require __DIR__.'/ReservaEquipo.php';
require __DIR__.'/ReservaEquipoArticulo.php';
require __DIR__.'/EquipoPrecio.php';
require __DIR__.'/Inventario.php';
require __DIR__.'/Marca.php';
require __DIR__.'/Modelo.php';
require __DIR__.'/Pago.php';
require __DIR__.'/MetodoPago.php';
require __DIR__.'/Moneda.php';
require __DIR__.'/Empleado.php';
require __DIR__.'/User.php';
require __DIR__.'/TrasladoPrecio.php';
require __DIR__.'/TipoPersona.php';
require __DIR__.'/clientes.php';