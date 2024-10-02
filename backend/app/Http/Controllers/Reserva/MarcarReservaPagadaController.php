<?php
namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reserva\MarcarReservaPagadaRequest;
use App\Models\Pago;
use App\Repositories\Reserva\ReservaRepository;
use App\Models\ReservaEstado;
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

            $pago = Pago::create([
                'total' => $reserva->calculateTotalPrice(),
                'status' => '',
                'reserva_id' => $reserva->id,
                'numero_comprobante' => '',
                'metodo_pago_id' => $request->metodo_pago_id,
                'moneda_id' => $request->moneda_id
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($pago, 201);
    }
}