<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientes\StoreReservaClienteRequest;
use App\Mail\EnviarConfirmacion;
use App\Models\Equipo;
use App\Models\EquipoDescuento;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoDescuento;
use App\Models\ReservaEquipoPrecio;
use App\Repositories\Reserva\ReservaRepository;
use App\Models\ReservaEstado;
use App\Models\Traslado;
use App\Models\TrasladoPrecio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Period\Period;

class StoreReservaClienteController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreReservaClienteRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->except(['equipos', 'traslados']);
            $reserva = $this->repository->create($data);

            ReservaEstado::create([
                'reserva_id' => $reserva->id,
                'estado_id' => 1
            ]);

            // guardar equipos
            $equipos = $request->equipos;

            foreach ($equipos as $equipo) {
                $data = [
                    'nombre' => $equipo["nombre"],
                    'apellido' => $equipo["apellido"],
                    'reserva_id' => $reserva->id,
                    'equipo_id' => $equipo["equipo_id"],
                ];

                $reservaEquipo = ReservaEquipo::create($data);

                $equipo = Equipo::find($equipo["equipo_id"]);

                $precios = $equipo->precios_vigentes_en_rango($reserva->fecha_desde, $reserva->fecha_hasta)
                    ->get();

                foreach ($precios as $precio) {
                    // Crear reserva_equipo_precio
                    ReservaEquipoPrecio::create([
                        'reserva_equipo_id' => $reservaEquipo->id,
                        'equipo_precio_id' => $precio->id,
                        'precio' => $precio->precio,
                        'fecha_desde' => $precio->fecha_desde,
                        'fecha_hasta' => $precio->fecha_hasta ?? $reserva->fecha_hasta,
                    ]);
                }

                $descuento = $this->getDescuentoByDays(
                    $equipo->id,
                    $reserva->fecha_desde,
                    $reserva->fecha_hasta
                );

                if (!empty($descuento)) {
                    ReservaEquipoDescuento::create([
                        'reserva_equipo_id' => $reservaEquipo->id,
                        'equipo_descuento_id' => $descuento->id,
                        'descuento' => $descuento->descuento->valor,
                        'dias' => $descuento->dias
                    ]);
                }
            }

            // guardar traslados
            $traslados = $request->traslados;
            $startDate = $reserva->fecha_desde;
            $endDate = $reserva->fecha_hasta;

            foreach ($traslados as $traslado) {
                $precio = TrasladoPrecio::where(function ($query) use ($startDate, $endDate) {
                    $query->where(function ($query) use ($startDate, $endDate) {
                        $query->whereDate('fecha_desde', '<=', $endDate)
                            ->whereDate('fecha_hasta', '>=', $startDate);
                    })
                        ->orWhere(function ($query) use ($startDate, $endDate) {
                            $query->whereDate('fecha_desde', '<=', $endDate)
                                ->whereNull('fecha_hasta');
                        });
                })
                    ->orderBy('fecha_hasta', 'asc')
                    ->first();

                $data = [
                    'precio' => $precio->precio,
                    'traslado_precio_id' => $precio->id,
                    'reserva_id' => $reserva->id,
                    ...$traslado
                ];

                Traslado::create($data);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        // mandar mail en su propio try catch
        try {
            Mail::to($reserva->email)->send(new EnviarConfirmacion($reserva));
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()->json($reserva, 201);
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
