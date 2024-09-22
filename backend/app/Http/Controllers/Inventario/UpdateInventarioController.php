<?php
namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Repositories\Inventario\InventarioRepository;
use App\Http\Requests\Inventario\UpdateInventarioRequest;

class UpdateInventarioController extends Controller
{
    private $repository;

    public function __construct(InventarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateInventarioRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}
