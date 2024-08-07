<?php
namespace App\Http\Controllers\ReservaEquipoEquipoPrecio;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipoEquipoPrecio\ReservaEquipoEquipoPrecioRepository;

class GetReservaEquipoEquipoPrecioController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoEquipoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
