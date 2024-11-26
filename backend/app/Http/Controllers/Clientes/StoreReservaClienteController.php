<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientes\StoreReservaClienteRequest;
use App\Mail\EnviarConfirmacion;
use App\Models\ReservaEquipo;
use App\Repositories\Reserva\ReservaRepository;
use App\Models\ReservaEstado;
use App\Models\Traslado;
use App\Models\TrasladoPrecio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

                $fechaDesde = $reserva->fecha_desde;
                $fechaHasta = $reserva->fecha_hasta;

                $reservaEquipo->storePreciosAndDescuentos($fechaDesde, $fechaHasta);
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
}
