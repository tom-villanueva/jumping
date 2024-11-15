<?php

namespace App\Http\Controllers\Traslado;

use App\Http\Controllers\Controller;
use App\Repositories\Traslado\TrasladoRepository;
use App\Http\Requests\Traslado\StoreTrasladoRequest;
use App\Models\Reserva;
use App\Models\Traslado;
use App\Models\TrasladoAsiento;
use App\Models\TrasladoPrecio;
use Illuminate\Support\Facades\DB;

class StoreTrasladoController extends Controller
{
    private $repository;

    public function __construct(TrasladoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreTrasladoRequest $request)
    {
        DB::beginTransaction();

        try {
            $reserva = Reserva::find($request->reserva_id);

            $startDate = $reserva->fecha_desde;
            $endDate = $reserva->fecha_hasta;

            $trasladoCount = Traslado::where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($query) use ($startDate, $endDate) {
                    $query->whereDate('fecha_desde', '<=', $endDate)
                        ->whereDate('fecha_hasta', '>=', $startDate);
                });
            })->count();

            $trasladoAsiento = TrasladoAsiento::first();
            if ($trasladoAsiento && $trasladoCount + 1 > $trasladoAsiento->cantidad) {
                return response()->json([
                    'error' => 'Añadir un traslado excede la cantidad de asientos disponibles.'
                ], 422);
            }

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
                ...$request->all()
            ];

            $new_entity = $this->repository->create($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($new_entity, 201);
    }
}
