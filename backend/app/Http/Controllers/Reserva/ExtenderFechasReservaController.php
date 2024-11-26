<?php

namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reserva\ExtenderFechasReservaRequest;
use App\Models\ReservaEquipoPrecio;
use App\Models\ReservaEstado;
use App\Repositories\Reserva\ReservaRepository;
use Illuminate\Support\Facades\DB;

class ExtenderFechasReservaController extends Controller
{
    private $repository;

    public function __construct(
        ReservaRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function __invoke(ExtenderFechasReservaRequest $request, $id)
    {
        $estado = ReservaEstado::where('reserva_id', $id)
                ->where('estado_id', 2)
                ->first();
            
        if(!empty($estado)) {
            throw ValidationException::withMessages([
                'reserva_pagada' => 'La reserva ya esta paga.'
            ]);
        }

        DB::beginTransaction();

        try {
            $reserva = $this->repository->find($id);

            $reserva = $this->repository->update($id, [
                'fecha_desde' => $request->fecha_desde,
                'fecha_hasta' => $request->fecha_hasta,
                'fecha_prueba' => $request->fecha_prueba
            ]);
            
            $reservaEquipos = $reserva->equipos_reservados()->get();
            $fechaDesde = $request->fecha_desde;
            $fechaHasta = $request->fecha_hasta;

            foreach ($reservaEquipos as $reservaEquipo) {
                // borrar los precios
                ReservaEquipoPrecio::where('reserva_equipo_id', $reservaEquipo->id)
                    ->delete();

                $reservaEquipo->storePreciosAndDescuentos($fechaDesde, $fechaHasta);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($reserva);
    }
}