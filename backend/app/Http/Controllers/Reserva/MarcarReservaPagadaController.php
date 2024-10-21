<?php
namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reserva\MarcarReservaPagadaRequest;
use App\Models\MetodoPago;
use App\Models\Pago;
use App\Repositories\Reserva\ReservaRepository;
use App\Models\ReservaEstado;
use App\Models\TipoPersona;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
            
            if(!empty($estado)) {
                throw ValidationException::withMessages([
                    'reserva_pagada' => 'La reserva ya esta paga.'
                ]);
            }

            ReservaEstado::create([
                'reserva_id' => $reserva->id,
                'estado_id' => 2
            ]);

            $tipoPersona = TipoPersona::find($request->tipo_persona_id);
            $metodoPago = MetodoPago::find($request->metodo_pago_id);

            $reservaTotal = $reserva->calculateTotalPrice();

            $tipoPersonaDescuento = $reservaTotal * ($tipoPersona->descuento->valor / 100);
            $metodoPagoDescuento = $reservaTotal * ($metodoPago->descuento->valor / 100);
            
            $total = $reservaTotal - $metodoPagoDescuento - $tipoPersonaDescuento;

            $pago = Pago::create([
                'total' => $total,
                'status' => '',
                'reserva_id' => $reserva->id,
                'numero_comprobante' => '',
                'metodo_pago_id' => $request->metodo_pago_id,
                'moneda_id' => $request->moneda_id,
                'tipo_persona_id' => $request->tipo_persona_id,
                'tipo_persona_descuento' => $tipoPersona->descuento->valor,
                'metodo_pago_descuento' => $metodoPago->descuento->valor,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($pago, 201);
    }
}