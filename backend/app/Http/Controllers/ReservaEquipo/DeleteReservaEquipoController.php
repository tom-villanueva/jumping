<?php
namespace App\Http\Controllers\ReservaEquipo;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipo\ReservaEquipoRepository;

class DeleteReservaEquipoController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}
