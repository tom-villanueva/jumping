<?php
namespace App\Http\Controllers\ReservaEquipoArticulo;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipoArticulo\ReservaEquipoArticuloRepository;

class GetReservaEquipoArticuloController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
