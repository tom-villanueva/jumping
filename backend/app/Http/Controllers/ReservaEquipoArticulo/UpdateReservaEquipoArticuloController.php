<?php
namespace App\Http\Controllers\ReservaEquipoArticulo;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipoArticulo\ReservaEquipoArticuloRepository;
use App\Http\Requests\ReservaEquipoArticulo\UpdateReservaEquipoArticuloRequest;

class UpdateReservaEquipoArticuloController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateReservaEquipoArticuloRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}
