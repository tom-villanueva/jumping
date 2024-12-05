<?php

namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reserva\MarcarReservaPagadaRequest;
use App\Models\MetodoPago;
use App\Models\Pago;
use App\Repositories\Reserva\ReservaRepository;
use App\Models\ReservaEstado;
use App\Models\TipoPersona;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Spatie\Period\Period;

class MarcarReservaPagadaController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(MarcarReservaPagadaRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $reserva = $this->repository->find($id);

            $estado = ReservaEstado::where('reserva_id', $reserva->id)
                ->where('estado_id', 2)
                ->first();

            if (!empty($estado)) {
                throw ValidationException::withMessages([
                    'reserva_pagada' => 'La reserva ya está paga.'
                ]);
            }

            ReservaEstado::create([
                'reserva_id' => $reserva->id,
                'estado_id' => 2
            ]);

            $reservaTotal = $reserva->calculateTotalPrice();

            // Descuento de método de pago
            $metodoPago = MetodoPago::find($request->metodo_pago_id);

            $metodoPagoDescuento = 0;
            if (!empty($metodoPago->descuento)) {
                $metodoPagoDescuento = $reservaTotal * ($metodoPago->descuento->valor / 100);
            }

            // Descuento de tipo de persona
            $cliente = $reserva->cliente;

            $tipoPersonaDescuento = 0;
            if (!empty($cliente->tipo_persona_id)) {
                $tipoPersona = TipoPersona::find($cliente->tipo_persona_id);
                $tipoPersonaDescuento = $tipoPersona->descuento 
                    ? $reservaTotal * ($tipoPersona->descuento->valor / 100)
                    : 0;
            }

            // Descuento de voucher
            $voucher = $reserva->voucher;
            $equiposReservados = $reserva->equipos_reservados;
            $voucherDescuento = 0;
            $reservaStartDate = Carbon::parse($reserva->fecha_desde);
            $reservaEndDate = Carbon::parse($reserva->fecha_hasta);

            if (!empty($voucher)) {
                $equipoVouchers = $voucher->equipo_voucher()->get();

                foreach ($equipoVouchers as $equipoVoucher) {
                    $equipo = $equipoVoucher->equipo;

                    // Check if the equipo is in the equiposReservados array
                    $reservaEquipo = $equiposReservados->first(function ($reservado) use ($equipo) {
                        return $reservado->equipo_id === $equipo->id;
                    });

                    if ($reservaEquipo) {
                        // Remaining voucher days to apply discount
                        $diasDescuento = $voucher->dias;

                        foreach ($reservaEquipo->precios as $reservaEquipoPrecio) {
                            $precioStartDate = Carbon::parse($reservaEquipoPrecio->fecha_desde);
                            $precioEndDate = Carbon::parse($reservaEquipoPrecio->fecha_hasta);

                            // Calculate overlapping days between reservation and price period
                            $daysForThisPrice = $this->getOverlappingDays(
                                $reservaStartDate,
                                $reservaEndDate,
                                $precioStartDate,
                                $precioEndDate
                            );

                            // Limit the days to the voucher's available discount days
                            $applicableDays = min($diasDescuento, $daysForThisPrice);

                            if ($applicableDays > 0) {
                                // Calculate discounted price for these days
                                $discountAmount = $reservaEquipoPrecio->precio * $applicableDays;

                                // If there is a descuento, apply it
                                $descuento = $reservaEquipo->descuentos()->first();
                                if ($descuento) {
                                    $discountAmount *= 1 - ($descuento->descuento / 100);
                                }

                                $voucherDescuento += $discountAmount;

                                // Reduce voucher days
                                $diasDescuento -= $applicableDays;
                            }

                            // Exit early if all voucher days are consumed
                            if ($diasDescuento <= 0) {
                                continue;
                            }
                        }
                    }
                }
            }

            $total = $reservaTotal - $metodoPagoDescuento - $tipoPersonaDescuento - $voucherDescuento;
            $total = $total < 0 ? 0 : $total;

            $pago = Pago::create([
                'total' => $total,
                'status' => '',
                'reserva_id' => $reserva->id,
                'numero_comprobante' => '',
                'metodo_pago_id' => $request->metodo_pago_id,
                'moneda_id' => $request->moneda_id,
                'tipo_persona_id' => $cliente->tipo_persona_id,
                'tipo_persona_descuento' => $tipoPersona->descuento? $tipoPersona->descuento->valor : 0,
                'metodo_pago_descuento' => $metodoPago->descuento ? $metodoPago->descuento->valor : 0,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($pago, 201);
    }

    private function getOverlappingDays(Carbon $startDate1, Carbon $endDate1, Carbon $startDate2, Carbon $endDate2)
    {
        $period1 = Period::make($startDate1, $endDate1);
        $period2 = Period::make($startDate2, $endDate2);

        $resultingPeriod = $period1->overlap($period2);

        return $resultingPeriod->length();
    }
}
