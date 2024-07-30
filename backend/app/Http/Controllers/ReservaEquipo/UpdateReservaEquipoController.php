<?php
namespace App\Http\Controllers\ReservaEquipo;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipo\ReservaEquipoRepository;
use App\Http\Requests\ReservaEquipo\UpdateReservaEquipoRequest;

class UpdateReservaEquipoController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateReservaEquipoRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}
