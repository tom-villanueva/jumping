<?php
namespace App\Http\Controllers\Reserva;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Reserva\ReservaRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class GetReservaContratoController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $reservaId = $request->query('reserva_id');

        $reserva = $this->repository->find($reservaId);

        $today = Carbon::now()->format('Y-m-m');

        $fileName = "contrato-reserva-nro-{$reservaId}-{$today}.pdf";

        $pdf = Pdf::loadView('pdf.contrato', [
            'id' => $reserva->id,
            'fecha_desde' => Carbon::parse($reserva->fecha_desde)->format('d/m/Y'),
            'fecha_hasta' => Carbon::parse($reserva->fecha_hasta)->format('d/m/Y'),
            'nombre' => "{$reserva->cliente->apellido}, {$reserva->cliente->nombre}"
        ]);

        return $pdf->stream($fileName);
    }
}
