<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use App\Models\Equipo;
use App\Models\EquipoDescuento;
use App\Models\TrasladoPrecio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Period\Period;

class GetEquiposByFechasController extends Controller
{
    public function __construct() {}

    public function __invoke(Request $request)
    {
        $fechaDesde = Carbon::parse($request->fecha_desde)->format('Y-m-d');
        $fechaHasta = Carbon::parse($request->fecha_hasta)->format('Y-m-d');

        $result = [];

        $equipos = Equipo::where('disponible', true)->get();

        foreach ($equipos as $equipo) {
            $precios = $equipo->precios_vigentes_en_rango($fechaDesde, $fechaHasta)
                ->get();

            $precioFechas = [];

            $descuento = $equipo->getDescuentoByDays($fechaDesde, $fechaHasta);

            $totalBruto = 0;
            $totalNeto = 0;

            foreach ($precios as $precio) {
                $overlappedDays = $this->getOverlappingDays(
                    Carbon::parse($request->fecha_desde),
                    Carbon::parse($request->fecha_hasta),
                    Carbon::parse($precio->fecha_desde),
                    Carbon::parse($precio->fecha_hasta ?? $fechaHasta)
                );

                $p = [];
                $p['fecha_desde'] = $precio->fecha_desde;
                $p['fecha_hasta'] = $precio->fecha_hasta ?? $fechaHasta;
                $p['precio'] = $precio->precio;
                $p['dias'] = $overlappedDays;
                $totalBruto += $precio->precio * $overlappedDays;

                if (!empty($descuento)) {
                    $totalNeto += ($precio->precio - ($precio->precio * ($descuento->descuento->valor / 100))) * $overlappedDays;
                } else {
                    $totalNeto += $precio->precio * $overlappedDays;
                }

                $precioFechas[] = $p;
            }

            $equipo['precios'] = $precioFechas;
            $equipo['descuento'] = $descuento ? $descuento->descuento : null;
            $equipo['total_bruto'] = $totalBruto;
            $equipo['total_neto'] = $totalNeto;

            $result[] = $equipo;
        }

        $precioTraslado = TrasladoPrecio::where(function ($query) use ($fechaDesde, $fechaHasta) {
                $query->where(function ($query) use ($fechaDesde, $fechaHasta) {
                    $query->whereDate('fecha_desde', '<=', $fechaHasta)
                        ->whereDate('fecha_hasta', '>=', $fechaDesde);
                })
                    ->orWhere(function ($query) use ($fechaDesde, $fechaHasta) {
                        $query->whereDate('fecha_desde', '<=', $fechaHasta)
                            ->whereNull('fecha_hasta');
                    });
            })
                ->orderBy('fecha_hasta', 'asc')
                ->first();

        $periodoReserva = Period::make($fechaDesde, $fechaHasta);
        $dias = $periodoReserva->length();
        $totalTraslado = $precioTraslado->precio * $dias;
        
        $traslado = [
            "descripcion" => "traslado",
            "precio" => $precioTraslado->precio,
            "total_bruto" => $totalTraslado,
            "total_neto" => $totalTraslado
        ];

        $result[] = $traslado;

        return response()->json($result);
    }

    private function getOverlappingDays(Carbon $startDate1, Carbon $endDate1, Carbon $startDate2, Carbon $endDate2)
    {
        $period1 = Period::make($startDate1, $endDate1);
        $period2 = Period::make($startDate2, $endDate2);

        $resultingPeriod = $period1->overlap($period2);

        return $resultingPeriod->length();
    }
}
