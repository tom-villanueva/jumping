<?php

namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Models\MetodoPago;
use App\Models\Reserva;
use App\Models\ReservaEquipo;
use App\Models\Traslado;
use App\Repositories\Reserva\ReservaRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Period\Period;

class GetReservaFacturaLineasController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request, $id)
    {
        $reservaId = $id;
        $metodoPagoId = $request->query('metodo_pago_id');

        // Fetch Reserva
        $reserva = Reserva::with([
            'equipos_reservados.precios',
            'equipos_reservados.descuentos',
            'traslados',
            'cliente.tipo_persona.descuento',
            'voucher.equipo_voucher.equipo',
        ])->findOrFail($reservaId);

        // Initialize invoice lines and totals
        $invoiceLines = [];
        $totalPrice = 0;
        $totalDiscount = 0;

        // Calculate equipo prices
        foreach ($reserva->equipos_reservados as $reservaEquipo) {
            $equipoPrice = $this->calculateReservaEquipoPrice($reserva, $reservaEquipo);

            $invoiceLines[] = [
                'descripcion' => "Equipo: {$reservaEquipo->equipo->descripcion}",
                'precio' => $equipoPrice['precio'],
            ];

            $totalPrice += $equipoPrice['precio'];
            $totalDiscount += $equipoPrice['descuento'];
        }

        // Calculate traslado prices
        foreach ($reserva->traslados as $traslado) {
            $trasladoPrice = $this->calculateReservaTrasladoPrice($reserva, $traslado);

            $invoiceLines[] = [
                'descripcion' => "Traslado: {$traslado->direccion}",
                'precio' => $trasladoPrice,
            ];

            $totalPrice += $trasladoPrice;
        }

        // Apply client discount (TipoPersona)
        $tipoPersonaDescuento = 0;
        if ($reserva->cliente->tipo_persona && $reserva->cliente->tipo_persona->descuento) {
            $tipoPersonaDescuento = $totalPrice * ($reserva->cliente->tipo_persona->descuento->valor / 100);

            $invoiceLines[] = [
                'descripcion' => "Descuento por tipo de cliente ({$reserva->cliente->tipo_persona->descripcion})",
                'precio' => -$tipoPersonaDescuento,
            ];

            $totalDiscount += $tipoPersonaDescuento;
        }

        // Apply payment method discount
        $metodoPagoDescuento = 0;
        if ($metodoPagoId) {
            $metodoPago = MetodoPago::with('descuento')->find($metodoPagoId);

            if ($metodoPago && $metodoPago->descuento) {
                $metodoPagoDescuento = $totalPrice * ($metodoPago->descuento->valor / 100);

                $invoiceLines[] = [
                    'descripcion' => "Descuento por método de pago ({$metodoPago->descripcion})",
                    'precio' => -$metodoPagoDescuento,
                ];

                $totalDiscount += $metodoPagoDescuento;
            }
        }

        // Apply voucher discounts
        if ($reserva->voucher) {
            $voucherDescuento = $this->calculateVoucherDiscount($reserva);

            $invoiceLines[] = [
                'descripcion' => "Descuento por voucher",
                'precio' => -$voucherDescuento,
            ];

            $totalDiscount += $voucherDescuento;
        }

        // Calculate final price after discounts
        $priceAfterDiscounts = $totalPrice - $totalDiscount;
        $priceAfterDiscounts = $priceAfterDiscounts < 0 ? 0 : $priceAfterDiscounts;

        // Build response
        return response()->json([
            'invoice' => $invoiceLines,
            'total_price' => round($totalPrice, 2),
            'price_after_discounts' => round($priceAfterDiscounts, 2),
        ]);
    }

    private function calculateReservaEquipoPrice(Reserva $reserva, ReservaEquipo $reservaEquipo)
    {
        $totalPrice = 0;
        $totalDiscount = 0;

        $startDate = Carbon::parse($reserva->fecha_desde);
        $endDate = Carbon::parse($reserva->fecha_hasta);

        $descuento = $reservaEquipo->descuentos()->first();

        foreach ($reservaEquipo->precios as $reservaEquipoPrecio) {
            $precioStartDate = Carbon::parse($reservaEquipoPrecio->fecha_desde);
            $precioEndDate = Carbon::parse($reservaEquipoPrecio->fecha_hasta);

            $daysForThisPrice = $this->getOverlappingDays($startDate, $endDate, $precioStartDate, $precioEndDate);
            $priceForThisPeriod = $reservaEquipoPrecio->precio * $daysForThisPrice;

            if (!empty($descuento)) {
                $priceForThisPeriod -= $priceForThisPeriod * ($descuento->descuento / 100);
            }

            $totalPrice += $priceForThisPeriod;
        }

        return [
            'precio' => round($totalPrice, 2),
            'descuento' => round($totalDiscount, 2),
        ];
    }
    
    private function calculateVoucherDiscount(Reserva $reserva)
    {
        $voucher = $reserva->voucher;
        $equiposReservados = $reserva->equipos_reservados;

        $voucherDescuento = 0;
        $diasDescuento = $voucher->dias;

        $startDate = Carbon::parse($reserva->fecha_desde);
        $endDate = Carbon::parse($reserva->fecha_hasta);

        foreach ($voucher->equipo_voucher as $equipoVoucher) {
            $reservaEquipo = $equiposReservados->firstWhere('equipo_id', $equipoVoucher->equipo->id);

            if ($reservaEquipo) {
                $diasDescuento = $voucher->dias;

                foreach ($reservaEquipo->precios as $reservaEquipoPrecio) {
                    $reservaEquipoPrecioStartDate = Carbon::parse($reservaEquipoPrecio->fecha_desde);
                    $reservaEquipoPrecioEndDate = Carbon::parse($reservaEquipoPrecio->fecha_hasta);

                    $daysForThisPrice = $this->getOverlappingDays(
                        $startDate,
                        $endDate,
                        $reservaEquipoPrecioStartDate,
                        $reservaEquipoPrecioEndDate
                    );

                    $applicableDays = min($diasDescuento, $daysForThisPrice);

                    $voucherDescuento += $reservaEquipoPrecio->precio * $applicableDays;
                    $diasDescuento -= $applicableDays;

                    if ($diasDescuento <= 0) {
                        continue;
                    }
                }
            }
        }

        return round($voucherDescuento, 2);
    }

    private function calculateReservaTrasladoPrice(Reserva $reserva, Traslado $traslado)
    {
        $reservaStartDate = Carbon::parse($reserva->fecha_desde);
        $reservaEndDate = Carbon::parse($reserva->fecha_hasta);

        $trasladoStartDate = Carbon::parse($traslado->fecha_desde);
        $trasladoEndDate = Carbon::parse($traslado->fecha_hasta);

        // Calculate overlapping days between the reservation and traslado periods
        $overlappingDays = $this->getOverlappingDays(
            $reservaStartDate,
            $reservaEndDate,
            $trasladoStartDate,
            $trasladoEndDate
        );

        // Calculate the price for the overlapping days
        $priceForTraslado = $traslado->precio * $overlappingDays;

        return $priceForTraslado;
    }


    private function getOverlappingDays(Carbon $startDate1, Carbon $endDate1, Carbon $startDate2, Carbon $endDate2)
    {
        $period1 = Period::make($startDate1, $endDate1);
        $period2 = Period::make($startDate2, $endDate2);

        $resultingPeriod = $period1->overlap($period2);

        return $resultingPeriod->length();
    }
}
