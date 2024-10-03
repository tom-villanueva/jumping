<?php

namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reserva\ExtenderReservaRequest;
use App\Models\Equipo;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoArticulo;
use App\Models\ReservaEquipoDescuento;
use App\Models\ReservaEquipoPrecio;
use App\Models\ReservaEstado;
use App\Repositories\Reserva\ReservaRepository;
use Illuminate\Support\Facades\DB;

class ExtenderReservaController extends Controller
{
    private $repository;

    public function __construct(
        ReservaRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function __invoke(ExtenderReservaRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $reserva = $this->repository->find($id);

            $data = [
                ...$request->except(['reserva_equipo_ids', 'es_extension']),
                'user_id' => $reserva->user_id,
                'nombre' => $reserva->nombre,
                'apellido' => $reserva->apellido,
                'email' => $reserva->email,
                'telefono' => $reserva->telefono
            ];

            $newReserva = $this->repository->create($data);

            ReservaEstado::create([
                'reserva_id' => $newReserva->id,
                'estado_id' => 1
            ]);

            $reservaEquipoIds = array_column($request->reserva_equipo_ids, 'reserva_equipo_id');

            foreach ($reservaEquipoIds as $id) {
                $oldReservaEquipo = ReservaEquipo::find($id);
                $equipo = Equipo::find($oldReservaEquipo->equipo_id);

                $newReservaEquipo = $this->storeReservaEquipo($oldReservaEquipo, $newReserva, $equipo);

                foreach ($oldReservaEquipo->articulos as $articulo) {
                    $articulo->update([
                        'devuelto' => true
                    ]);

                    // SI es extension
                    // paso el mismo artículo a la nueva reserva
                    if ($request->es_extension) {
                        ReservaEquipoArticulo::create([
                            'reserva_equipo_id' => $newReservaEquipo->id,
                            'articulo_id' => $articulo->articulo_id,
                            'devuelto' => false,
                        ]);
                    }
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($newReserva);
    }

    public function storeReservaEquipo($oldReservaEquipo, $reserva, $equipo)
    {
        $data = [
            'altura' => $oldReservaEquipo->altura,
            'peso' => $oldReservaEquipo->peso,
            'num_calzado' => $oldReservaEquipo->num_calzado,
            'nombre' => $oldReservaEquipo->nombre,
            'apellido' => $oldReservaEquipo->apellido,
            'reserva_id' => $reserva->id,
            'equipo_id' => $equipo->id,
        ];

        $reserva_equipo = ReservaEquipo::create($data);

        $fechaDesde = $reserva->fecha_desde;
        $fechaHasta = $reserva->fecha_hasta;

        $precios = $equipo->precios_vigentes_en_rango($fechaDesde, $fechaHasta)
            ->get();

        foreach ($precios as $precio) {
            // Crear reserva_equipo_precio
            ReservaEquipoPrecio::create([
                'reserva_equipo_id' => $reserva_equipo->id,
                'equipo_precio_id' => $precio->id,
                'precio' => $precio->precio,
                'fecha_desde' => $precio->fecha_desde,
                'fecha_hasta' => $precio->fecha_hasta ?? $fechaHasta,
            ]);
        }

        $equipo_descuentos = $equipo->descuentos_vigentes_en_rango($fechaDesde, $fechaHasta)
            ->get();

        foreach ($equipo_descuentos as $equipo_descuento) {
            // Crear reserva_equipo_descuento
            $equipo_descuento_id = $equipo_descuento->pivot->id;
            ReservaEquipoDescuento::create([
                'reserva_equipo_id' => $reserva_equipo->id,
                'equipo_descuento_id' => $equipo_descuento_id,
                'descuento' => $equipo_descuento->valor,
                'fecha_desde' => $equipo_descuento->pivot->fecha_desde,
                'fecha_hasta' => $equipo_descuento->pivot->fecha_hasta
            ]);
        }

        return $reserva_equipo;
    }
}
