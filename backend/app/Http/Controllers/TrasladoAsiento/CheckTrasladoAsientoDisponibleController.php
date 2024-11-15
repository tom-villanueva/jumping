<?php
namespace App\Http\Controllers\TrasladoAsiento;

use App\Http\Controllers\Controller;
use App\Models\Traslado;
use App\Models\TrasladoAsiento;
use App\Repositories\TrasladoAsiento\TrasladoAsientoRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckTrasladoAsientoDisponibleController extends Controller
{
    private $repository;

    public function __construct(TrasladoAsientoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $fechaDesde = Carbon::parse($request->fecha_desde)->format('Y-m-d');
        $fechaHasta = Carbon::parse($request->fecha_hasta)->format('Y-m-d');

        $trasladoCount = Traslado::where(function ($query) use ($fechaDesde, $fechaHasta) {
            $query->where(function ($query) use ($fechaDesde, $fechaHasta) {
                $query->whereDate('fecha_desde', '<=', $fechaHasta)
                    ->whereDate('fecha_hasta', '>=', $fechaDesde);
            });
        })->count();

        $trasladoAsiento = TrasladoAsiento::first();

        if(empty($trasladoAsiento)) {
            return response()->json([
                'error' => 'Ocurrió un error al chequear.',
                'message' => 'No hay registro de asientos máximos.'
            ], 500);
        }

        $asientosDisponibles = $trasladoAsiento->cantidad - $trasladoCount;

        $data = [
            'fecha_desde' => $fechaDesde,
            'fecha_hasta' => $fechaHasta,
            'asientos_reservados' => $trasladoCount,
            'asientos_maximos' => $trasladoAsiento->cantidad,
            'asientos_disponibles' => $asientosDisponibles < 0 ? 0 : $asientosDisponibles,
        ];

        return response()->json($data);
    }
}
