<?php
namespace App\Http\Controllers\ReservaEquipo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipo\ReservaEquipoRepository;
use App\Http\Requests\ReservaEquipo\StoreReservaEquipoRequest;

class StoreReservaEquipoController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreReservaEquipoRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}