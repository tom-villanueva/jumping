<?php
namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Repositories\Inventario\InventarioRepository;

class DeleteInventarioController extends Controller
{
    private $repository;

    public function __construct(InventarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}
