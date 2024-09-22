<?php
namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Repositories\Inventario\InventarioRepository;

class GetByIdInventarioController extends Controller
{
    private $repository;

    public function __construct(InventarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}