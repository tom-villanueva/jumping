<?php
namespace App\Http\Controllers\Modelo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Modelo\ModeloRepository;
use App\Http\Requests\Modelo\StoreModeloRequest;

class StoreModeloController extends Controller
{
    private $repository;

    public function __construct(ModeloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreModeloRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}