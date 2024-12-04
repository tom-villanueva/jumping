<?php
namespace App\Http\Controllers\TipoEquipo;

use App\Http\Controllers\Controller;
use App\Repositories\TipoEquipo\TipoEquipoRepository;

class DeleteTipoEquipoController extends Controller
{
    private $repository;

    public function __construct(TipoEquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}
