<?php
namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Repositories\Reserva\ReservaRepository;
use Carbon\Carbon;
use Spatie\Period\Period;

class GetDesgloseDePreciosReservaController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        // Retrieve the Reserva model with related equipos_reservados and their prices/discounts
        $reserva = Reserva::with(['equipos_reservados.precios.equipo_precio', 'equipos_reservados.descuentos.equipo_descuento'])
            ->findOrFail($id);

        $priceBreakdown = [];

        foreach ($reserva->equipos_reservados as $reservaEquipo) {
            // Get the reservation dates
            $reservaStartDate = Carbon::parse($reserva->fecha_desde);
            $reservaEndDate = Carbon::parse($reserva->fecha_hasta);

            // Fetch the descuento (max 1 discount per reservaEquipo)
            $descuento = $reservaEquipo->descuentos()->first();

            // Loop through all prices for the current equipo
            foreach ($reservaEquipo->precios as $reservaEquipoPrecio) {
                $precioStartDate = Carbon::parse($reservaEquipoPrecio->fecha_desde);
                $precioEndDate = Carbon::parse($reservaEquipoPrecio->fecha_hasta);

                // Calculate the overlapping days between the reservation and the price period
                $dias = $this->getOverlappingDays($reservaStartDate, $reservaEndDate, $precioStartDate, $precioEndDate);

                // Apply discount if exists
                $precio = $reservaEquipoPrecio->precio;
                $descuentoAmount = $descuento ? ($descuento->descuento / 100) * $precio : 0;
                $total = ($precio - $descuentoAmount) * $dias;

                // Append the breakdown for this equipment
                $priceBreakdown[] = [
                    'equipo_descripcion' => $reservaEquipo->equipo->descripcion,
                    'precio' => $precio,
                    'descuento' => $descuento ? $descuento->descuento : 0,
                    'dias' => $dias,
                    'total' => $total
                ];
            }
        }

        return response()->json($priceBreakdown);
    }

    /**
     * Calculate the number of overlapping days between two date ranges.
     *
     * @param Carbon $startDate1
     * @param Carbon $endDate1
     * @param Carbon $startDate2
     * @param Carbon $endDate2
     * @return int
     */
    private function getOverlappingDays(Carbon $startDate1, Carbon $endDate1, Carbon $startDate2, Carbon $endDate2)
    {
        $period1 = Period::make($startDate1, $endDate1);
        $period2 = Period::make($startDate2, $endDate2);

        $resultingPeriod = $period1->overlap($period2);

        return $resultingPeriod->length();
    }
}
