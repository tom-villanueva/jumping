<?php

namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reserva\ExtenderFechasReservaRequest;
use App\Models\Equipo;
use App\Models\EquipoDescuento;
use App\Models\ReservaEquipoDescuento;
use App\Models\ReservaEquipoPrecio;
use App\Models\ReservaEstado;
use App\Repositories\Reserva\ReservaRepository;
use Illuminate\Support\Facades\DB;
use Spatie\Period\Period;

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

                $equipo = Equipo::find($reservaEquipo->equipo_id);

                $precios = $equipo->precios_vigentes_en_rango($fechaDesde, $fechaHasta)
                    ->get();

                foreach ($precios as $precio) {
                    // Crear reserva_equipo_precio
                    ReservaEquipoPrecio::create([
                        'reserva_equipo_id' => $reservaEquipo->id,
                        'equipo_precio_id' => $precio->id,
                        'precio' => $precio->precio,
                        'fecha_desde' => $precio->fecha_desde,
                        'fecha_hasta' => $precio->fecha_hasta ?? $fechaHasta,
                    ]);
                }

                $descuento = $this->getDescuentoByDays($equipo->id, $fechaDesde, $fechaHasta);

                if(!empty($descuento)) {
                    ReservaEquipoDescuento::create([
                        'reserva_equipo_id' => $reservaEquipo->id,
                        'equipo_descuento_id' => $descuento->id,
                        'descuento' => $descuento->descuento->valor,
                        'dias' => $descuento->dias
                    ]);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($reserva);
    }

    public function getDescuentoByDays($equipoId, $fechaDesde, $fechaHasta)
    {
        // Create a period for the reservation dates
        $reservaPeriod = Period::make($fechaDesde, $fechaHasta);
        $dias = $reservaPeriod->length();

        // Get all EquipoDescuentos for the given Equipo
        $descuentos = EquipoDescuento::where('equipo_id', $equipoId)->orderBy('dias')->get();

        // Check if there are any descuentos for the given equipo
        if ($descuentos->isEmpty()) {
            return null;
        }

        // Look for an exact match of 'dias'
        $exactMatch = $descuentos->firstWhere('dias', $dias);
        if ($exactMatch) {
            return $exactMatch;
        }

        // Find the lowest and highest 'dias' values
        $lowestDescuento = $descuentos->first();
        $highestDescuento = $descuentos->last();

        // If $dias is lower than the lowest 'dias', return null
        if ($dias < $lowestDescuento->dias) {
            return null;
        }

        // If $dias is greater than the highest 'dias', return the highest EquipoDescuento
        if ($dias > $highestDescuento->dias) {
            return $highestDescuento;
        }

        // If no match is found, return null (this case should rarely happen if ordered correctly)
        return null;
    }
}