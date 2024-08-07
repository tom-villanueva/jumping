<?php
namespace App\Http\Controllers\ReservaEquipoEquipoPrecio;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipoEquipoPrecio\ReservaEquipoEquipoPrecioRepository;
use App\Http\Requests\ReservaEquipoEquipoPrecio\UpdateReservaEquipoEquipoPrecioRequest;

class UpdateReservaEquipoEquipoPrecioController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoEquipoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateReservaEquipoEquipoPrecioRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}
