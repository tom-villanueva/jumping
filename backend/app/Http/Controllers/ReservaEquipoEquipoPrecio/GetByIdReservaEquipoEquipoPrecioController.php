<?php
namespace App\Http\Controllers\ReservaEquipoEquipoPrecio;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipoEquipoPrecio\ReservaEquipoEquipoPrecioRepository;

class GetByIdReservaEquipoEquipoPrecioController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoEquipoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}