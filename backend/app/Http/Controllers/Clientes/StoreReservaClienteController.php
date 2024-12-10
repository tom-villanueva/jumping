<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clientes\StoreReservaClienteRequest;
use App\Mail\EnviarConfirmacion;
use App\Mail\EnviarCredenciales;
use App\Models\Cliente;
use App\Models\ReservaEquipo;
use App\Repositories\Reserva\ReservaRepository;
use App\Models\ReservaEstado;
use App\Models\Traslado;
use App\Models\TrasladoPrecio;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StoreReservaClienteController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreReservaClienteRequest $request)
    {
        DB::beginTransaction();

        try {
            $cliente = $this->handleCliente($request);
            $reserva = $this->createReserva($request, $cliente);
            $this->createReservaEstado($reserva);
            $this->handleEquipos($request, $reserva);
            $this->handleTraslados($request, $reserva);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        $this->sendConfirmationEmail($reserva);

        return response()->json($reserva, 201);
    }

    private function handleCliente(StoreReservaClienteRequest $request): Cliente
    {
        if ($request->filled('email')) {
            $cliente = Cliente::where('email', $request->email)->first();

            if ($cliente) {
                if (is_null($cliente->user_id) && $request->crear_user) {
                    $this->createUser($cliente);
                }
                return $cliente;
            }
        }

        if ($request->filled('user_id')) {
            return Cliente::where('user_id', $request->user_id)->firstOrFail();
        }

        $clienteData = $request->only(['nombre', 'apellido', 'email', 'telefono']);
        $clienteData['tipo_persona_id'] = 1;

        $cliente = Cliente::create($clienteData);

        if ($request->crear_user) {
            $this->createUser($cliente);
        }

        return $cliente;
    }

    private function createUser(Cliente $cliente): void
    {
        $password = $this->generatePassword();

        $user = User::create([
            'name' => "{$cliente->nombre} {$cliente->apellido}",
            'email' => $cliente->email,
            'password' => Hash::make($password)
        ]);

        $cliente->update(['user_id' => $user->id]);

        try {
            Mail::to($cliente->email)->send(new EnviarCredenciales($cliente, $password));
        } catch (\Throwable $th) {
            // Log the error instead of re-throwing
            logger()->error("Failed to send credentials email: {$th->getMessage()}");
        }
    }

    private function generatePassword(): string
    {
        return Str::random(8)
            . Str::upper(Str::random(2))
            . Str::random(2, '0123456789')
            . Str::random(2, '!@#$%^&*()-_=+[]{}|;:,.<>?');
    }

    private function createReserva(StoreReservaClienteRequest $request, Cliente $cliente)
    {
        $data = $request->only(['fecha_prueba', 'fecha_desde', 'fecha_hasta']);
        $data['cliente_id'] = $cliente->id;

        return $this->repository->create($data);
    }

    private function createReservaEstado($reserva): void
    {
        ReservaEstado::create([
            'reserva_id' => $reserva->id,
            'estado_id' => 1
        ]);
    }

    private function handleEquipos(StoreReservaClienteRequest $request, $reserva): void
    {
        foreach ($request->equipos as $equipo) {
            $reservaEquipo = ReservaEquipo::create([
                'nombre' => $equipo['nombre'],
                'apellido' => $equipo['apellido'],
                'reserva_id' => $reserva->id,
                'equipo_id' => $equipo['equipo_id'],
            ]);

            $reservaEquipo->storePreciosAndDescuentos($reserva->fecha_desde, $reserva->fecha_hasta);
        }
    }

    private function handleTraslados(StoreReservaClienteRequest $request, $reserva): void
    {
        foreach ($request->traslados as $traslado) {
            $precio = $this->getTrasladoPrecio($reserva->fecha_desde, $reserva->fecha_hasta);

            Traslado::create([
                'precio' => $precio->precio,
                'traslado_precio_id' => $precio->id,
                'reserva_id' => $reserva->id,
                ...$traslado
            ]);
        }
    }

    private function getTrasladoPrecio($startDate, $endDate)
    {
        return TrasladoPrecio::where(function ($query) use ($startDate, $endDate) {
            $query->where(function ($query) use ($startDate, $endDate) {
                $query->whereDate('fecha_desde', '<=', $endDate)
                    ->whereDate('fecha_hasta', '>=', $startDate);
            })
                ->orWhere(function ($query) use ($startDate, $endDate) {
                    $query->whereDate('fecha_desde', '<=', $endDate)
                        ->whereNull('fecha_hasta');
                });
        })
            ->orderBy('fecha_hasta', 'asc')
            ->first();
    }

    private function sendConfirmationEmail($reserva): void
    {
        try {
            Mail::to($reserva->email)->send(new EnviarConfirmacion($reserva));
        } catch (\Throwable $th) {
            logger()->error("Failed to send confirmation email: {$th->getMessage()}");
        }
    }
}
