<?php

namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Repositories\Reserva\ReservaRepository;
use App\Http\Requests\Reserva\StoreReservaRequest;
use App\Mail\EnviarCredenciales;
use App\Models\Cliente;
use App\Models\ReservaEstado;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

            $cliente = $reserva->cliente;

            if($request->crear_user && is_null($cliente->user_id)) {
                $password = Str::random(8) // Base random string
                    . Str::upper(Str::random(2)) // Add uppercase letters
                    . Str::random(2, '0123456789') // Add numbers
                    . Str::random(2, '!@#$%^&*()-_=+[]{}|;:,.<>?'); // Add symbols 

                $user = User::create([
                    'name' => "{$cliente->nombre} {$cliente->apellido}",
                    'email' => $cliente->email,
                    'password' => Hash::make($password)
                ]);

                $cliente->update([
                    'user_id' => $user->id
                ]);

                Mail::to($cliente->email)->send(new EnviarCredenciales($cliente, $password));
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($reserva, 201);
    }
}
