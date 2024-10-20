<?php
namespace App\Http\Controllers\Articulo;

use App\Http\Controllers\Controller;
use App\Repositories\Articulo\ArticuloRepository;

class DeleteArticuloController extends Controller
{
    private $repository;

    public function __construct(ArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $articulo = $this->repository->find($id);

        $inventario = $articulo->inventario()->first();

        if(!empty($inventario)) {
            $result = $articulo->deleteQuietly();
            $inventario->delete();
        } else {
            $result = $this->repository->delete($id);
        }

        return response()->json($result);
    }
}
