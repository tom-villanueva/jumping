<?php

namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Repositories\Reserva\ReservaRepository;
use App\Models\Reserva;
use Illuminate\Support\Facades\DB;

class GetEstadisticasReservasController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        // Get the statistics per year
        $estadisticas = Reserva::with('pagos') // eager load Pago model
            ->selectRaw('EXTRACT(YEAR FROM fecha_desde) as year, COUNT(*) as cantidad_reservas, SUM(pagos.total) as ingreso_total')
            ->join('pagos', 'reservas.id', '=', 'pagos.reserva_id')
            ->groupByRaw('EXTRACT(YEAR FROM fecha_desde)')
            ->orderByRaw('year DESC')
            ->get()
            ->mapToGroups(function ($item) {
                return [
                    $item->year => [
                        'cantidad_reservas' => $item->cantidad_reservas,
                        'ingreso_total' => $item->ingreso_total
                    ]
                ];
            });

        // Monthly data: Get stats for specific months (June to October)
        $monthlyEstadisticas = Reserva::with('pagos')
            ->selectRaw('EXTRACT(MONTH FROM fecha_desde) as month, EXTRACT(YEAR FROM fecha_desde) as year, SUM(pagos.total) as total_ingreso')
            ->join('pagos', 'reservas.id', '=', 'pagos.reserva_id')
            ->whereIn(\DB::raw('EXTRACT(MONTH FROM fecha_desde)'), [6, 7, 8, 9, 10]) // Filter for June to October
            ->groupByRaw('EXTRACT(YEAR FROM fecha_desde), EXTRACT(MONTH FROM fecha_desde)')
            ->orderByRaw('year ASC, month ASC') // Ensure the months and years are ordered
            ->get()
            ->groupBy('month') // Group by month
            ->map(function ($monthData, $month) {
                // Map each month's data for 2023 and 2024
                $data = ['name' => $this->getMonthName($month)];

                foreach ($monthData as $record) {
                    $data[$record->year] = (float) $record->total_ingreso;
                }

                // Return data for this month
                return $data;
            })
            ->values(); // Ensure the result is a flat array and not an associative one

        // Return both arrays in the response
        return response()->json([
            'yearly_estadisticas' => $estadisticas,
            'monthly_estadisticas' => $monthlyEstadisticas
        ]);
    }

    // Helper function to get month names in Spanish
    private function getMonthName($month)
    {
        $months = [
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre'
        ];

        return $months[$month] ?? 'Unknown';
    }
}
