<?php
namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Repositories\Inventario\InventarioRepository;

class GetInventarioController extends Controller
{
    private $repository;

    public function __construct(InventarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
