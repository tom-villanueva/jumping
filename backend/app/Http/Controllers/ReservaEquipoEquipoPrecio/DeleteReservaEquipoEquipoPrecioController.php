<?php
namespace App\Http\Controllers\ReservaEquipoEquipoPrecio;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipoEquipoPrecio\ReservaEquipoEquipoPrecioRepository;

class DeleteReservaEquipoEquipoPrecioController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoEquipoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}
