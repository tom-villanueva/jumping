<?php
namespace App\Http\Controllers\TipoArticulo;

use App\Http\Controllers\Controller;
use App\Repositories\TipoArticulo\TipoArticuloRepository;

class DeleteTipoArticuloController extends Controller
{
    private $repository;

    public function __construct(TipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        if ($result) {
            return response()->json($result);
        }

        return response()->json([], 404);
    }
}
