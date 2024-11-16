<?php

namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Repositories\Reserva\ReservaRepository;
use App\Http\Requests\Reserva\StoreReservaRequest;
use App\Models\Cliente;
use App\Models\ReservaEstado;
use Illuminate\Support\Facades\DB;

class StoreReservaController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreReservaRequest $request)
    {
        DB::beginTransaction();

        try {
            if (empty($request->cliente_id)) {
                $cliente = Cliente::create([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'email' => $request->email,
                    'telefono' => $request->telefono,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                ]);

                $clienteId = $cliente->id;
            } else {
                $clienteId = $request->cliente_id;
            }

            $data = [
                ...$request->only([
                    'fecha_desde',
                    'fecha_hasta',
                    'fecha_prueba',
                    'comentario',
                ]),
                'cliente_id' => $clienteId
            ];

            $reserva = $this->repository->create($data);

            ReservaEstado::create([
                'reserva_id' => $reserva->id,
                'estado_id' => 1
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($reserva, 201);
    }
}
