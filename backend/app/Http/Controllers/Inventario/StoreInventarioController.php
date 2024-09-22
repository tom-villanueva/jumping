<?php
namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Inventario\InventarioRepository;
use App\Http\Requests\Inventario\StoreInventarioRequest;

class StoreInventarioController extends Controller
{
    private $repository;

    public function __construct(InventarioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreInventarioRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}