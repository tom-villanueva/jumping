<?php
namespace App\Http\Controllers\ReservaEquipo;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipo\ReservaEquipoRepository;
use App\Http\Requests\ReservaEquipo\StoreReservaEquipoRequest;
use App\Models\EquipoDescuento;
use App\Models\ReservaEquipoDescuento;
use App\Models\ReservaEquipoPrecio;
use App\Repositories\Equipo\EquipoRepository;
use App\Repositories\Reserva\ReservaRepository;
use Illuminate\Support\Facades\DB;
use Spatie\Period\Period;

class StoreReservaEquipoController extends Controller
{
    private $repository;
    private $equipoRepository;
    private $reservaRepository;

    public function __construct(
        ReservaEquipoRepository $repository,
        EquipoRepository $equipoRepository,
        ReservaRepository $reservaRepository
    )
    {
        $this->repository = $repository;
        $this->equipoRepository = $equipoRepository;
        $this->reservaRepository = $reservaRepository;
    }

    public function __invoke(StoreReservaEquipoRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = [
                ...$request->all(),
            ];

            $reserva_equipo = $this->repository->create($data);

            $reserva = $this->reservaRepository->find($request->reserva_id);
            $equipo = $this->equipoRepository->find($request->equipo_id);

            $fechaDesde = $reserva->fecha_desde;
            $fechaHasta = $reserva->fecha_hasta;

            $precios = $equipo->precios_vigentes_en_rango($fechaDesde, $fechaHasta)
                ->get();
            
            // dd($precios);

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
            
            // $equipo_descuentos = $equipo->descuentos_vigentes_en_rango($fechaDesde, $fechaHasta)
            //     ->get();

            $descuento = $this->getDescuentoByDays($equipo->id, $fechaDesde, $fechaHasta);

            if(!empty($descuento)) {
                ReservaEquipoDescuento::create([
                    'reserva_equipo_id' => $reserva_equipo->id,
                    'equipo_descuento_id' => $descuento->id,
                    'descuento' => $descuento->descuento->valor,
                    'dias' => $descuento->dias
                ]);
            }

            // foreach ($equipo_descuentos as $equipo_descuento) {
            //     // Crear reserva_equipo_descuento
            //     $equipo_descuento_id = $equipo_descuento->pivot->id;
            //     ReservaEquipoDescuento::create([
            //         'reserva_equipo_id' => $reserva_equipo->id,
            //         'equipo_descuento_id' => $equipo_descuento_id,
            //         'descuento' => $equipo_descuento->valor,
            //         'fecha_desde' => $equipo_descuento->pivot->fecha_desde,
            //         'fecha_hasta' => $equipo_descuento->pivot->fecha_hasta
            //     ]);
            // }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($reserva_equipo, 201);
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