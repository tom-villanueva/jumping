<?php
namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Repositories\Reserva\ReservaRepository;
use App\Http\Requests\Reserva\UpdateReservaRequest;
use App\Repositories\Cliente\ClienteRepository;

class UpdateReservaController extends Controller
{
    private $repository;
    private $clienteRepository;

    public function __construct(
        ReservaRepository $repository, 
        ClienteRepository $clienteRepository
    )
    {
        $this->repository = $repository;
        $this->clienteRepository = $clienteRepository;
    }

    public function __invoke(UpdateReservaRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->only('comentario'));

        $updatedCliente =  $this->clienteRepository->update($result->cliente_id, $request->only([
            'nombre',
            'apellido',
            'email',
            'telefono',
            'fecha_nacimiento'
        ]));

        $result = [
            'id' => $result->id,
            'cliente_id' => $result->cliente_id,
            'fecha_desde' => $result->fecha_desde,
            'fecha_hasta' => $result->fecha_hasta,
            'fecha_prueba' => $result->fecha_prueba,
            'nombre' => $updatedCliente->nombre,
            'apellido' => $updatedCliente->apellido,
            'email' => $updatedCliente->email,
            'telefono' => $updatedCliente->telefono,
            'fecha_nacimiento' => $updatedCliente->fecha_nacimiento,
            'comentario' => $result->comentario
        ];

        return response()->json($result);
    }
}
