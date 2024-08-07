<?php
namespace App\Http\Controllers\ReservaEquipoEquipoPrecio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipoEquipoPrecio\ReservaEquipoEquipoPrecioRepository;
use App\Http\Requests\ReservaEquipoEquipoPrecio\StoreReservaEquipoEquipoPrecioRequest;

class StoreReservaEquipoEquipoPrecioController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoEquipoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreReservaEquipoEquipoPrecioRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}