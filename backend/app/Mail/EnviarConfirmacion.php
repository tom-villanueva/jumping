<?php

namespace App\Mail;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;

use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Spatie\Period\Period;

class EnviarConfirmacion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected Reserva $reserva,
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Envío de Confirmación de reserva Jumping',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $fechaDesde = Carbon::parse($this->reserva->fecha_desde);
        $fechaHasta = Carbon::parse($this->reserva->fecha_hasta);
        $total = $this->reserva->calculateTotalPrice();

        $equipos = $this->reserva->equipos_reservados->flatMap(function ($reservaEquipo) use ($fechaDesde, $fechaHasta) {
            $descripcion = $reservaEquipo->equipo->descripcion;
            $descuento = $reservaEquipo->descuentos->first()?->equipo_descuento->descuento->valor ?? 0;

            return $reservaEquipo->precios->map(function ($precio) use ($descripcion, $descuento, $fechaDesde, $fechaHasta) {

                $dias = $this->getOverlappingDays(
                    Carbon::parse($fechaDesde),
                    Carbon::parse($fechaHasta),
                    Carbon::parse($precio->fecha_desde),
                    Carbon::parse($precio->fecha_hasta ?? $fechaHasta)
                );

                if ($dias <= 0) return null;  // Skip if no overlap in date ranges

                $precioDiario = $precio->precio;
                $precioConDescuento = $precioDiario * (1 - ($descuento / 100)); 
                $total = $precioConDescuento * $dias;

                return [
                    'descripcion' => $descripcion,
                    'precio_por_dia' => $precioDiario,
                    'descuento' => $descuento,
                    'dias' => $dias,
                    'precio_con_descuento' => $precioConDescuento,
                    'total' => $total,
                ];
            })->filter();
        })->values()->toArray();

        $traslados = $this->reserva->traslados()->get()->map(function ($traslado) {
            $fechaInicio = Carbon::parse($traslado->fecha_desde);
            $fechaFin = Carbon::parse($traslado->fecha_hasta);
            $days = Period::make($fechaInicio, $fechaFin)->length();
            $dailyPrice = $traslado->precio;
            $total = $days * $dailyPrice;

            return [
                'direccion' => $traslado->direccion,
                'fecha_inicio' => $fechaInicio->format('d/m/Y'),
                'fecha_fin' => $fechaFin->format('d/m/Y'),
                'dias' => $days,
                'precio_diario' => $dailyPrice,
                'total' => $total,
            ];
        });

        return new Content(
            view: 'mail.reservas.confirmacion',
            with: [
                'pathToImage' => 'images/jumping-logo.png',
                'reservaId' => $this->reserva->id,
                'nombre' => "{$this->reserva->apellido}, {$this->reserva->nombre}",
                'fecha_desde' => Carbon::parse($this->reserva->fecha_desde)->format('d/m/Y'),
                'fecha_hasta' => Carbon::parse($this->reserva->fecha_hasta)->format('d/m/Y'),
                'equipos' => $equipos,
                'traslados' => $traslados,
                'total' => $total
            ]
        );
    }

    private function getOverlappingDays(Carbon $startDate1, Carbon $endDate1, Carbon $startDate2, Carbon $endDate2)
    {
        $period1 = Period::make($startDate1, $endDate1);
        $period2 = Period::make($startDate2, $endDate2);

        $resultingPeriod = $period1->overlap($period2);

        return $resultingPeriod->length();
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
