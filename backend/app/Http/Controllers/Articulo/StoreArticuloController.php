<?php
namespace App\Http\Controllers\Articulo;

use App\Http\Controllers\Controller;
use App\Repositories\Articulo\ArticuloRepository;
use App\Http\Requests\Articulo\StoreArticuloRequest;

class StoreArticuloController extends Controller
{
    private $repository;

    public function __construct(ArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreArticuloRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity);
    }
}