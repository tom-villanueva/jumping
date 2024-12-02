<?php

namespace App\Http\Controllers\Reserva;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Reserva\ReservaRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class GetReservaFacturaController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $reservaId = $request->query('reserva_id');

        // Fetch reservation data
        $reserva = $this->repository->find($reservaId);

        // Fetch invoice lines (use your existing method to generate invoice data)
        $invoiceData = $this->repository->getReservaLineasFactura($reservaId);

        $today = Carbon::now()->format('Y-m-d');
        $fileName = "factura-reserva-nro-{$reservaId}-{$today}.pdf";

        // Generate PDF
        $pdf = Pdf::loadView('pdf.factura', [
            'id' => $reserva->id,
            'nombre' => "{$reserva->cliente->apellido}, {$reserva->cliente->nombre}",
            'fecha' => Carbon::now()->format('d/m/Y'),
            'invoice_lines' => $invoiceData['invoice'],
            'total_price' => $invoiceData['total_price'],
            'price_after_discounts' => $invoiceData['price_after_discounts'],
        ]);

        return $pdf->stream($fileName);
    }
}
