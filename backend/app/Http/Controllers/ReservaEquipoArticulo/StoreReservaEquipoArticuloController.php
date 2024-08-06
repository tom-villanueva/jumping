<?php
namespace App\Http\Controllers\ReservaEquipoArticulo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipoArticulo\ReservaEquipoArticuloRepository;
use App\Http\Requests\ReservaEquipoArticulo\StoreReservaEquipoArticuloRequest;

class StoreReservaEquipoArticuloController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreReservaEquipoArticuloRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}