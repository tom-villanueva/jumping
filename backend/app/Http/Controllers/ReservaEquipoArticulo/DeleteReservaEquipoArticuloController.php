<?php
namespace App\Http\Controllers\ReservaEquipoArticulo;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipoArticulo\ReservaEquipoArticuloRepository;

class DeleteReservaEquipoArticuloController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}
