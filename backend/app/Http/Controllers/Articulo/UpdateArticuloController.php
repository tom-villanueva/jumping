<?php
namespace App\Http\Controllers\Articulo;

use App\Http\Controllers\Controller;
use App\Repositories\Articulo\ArticuloRepository;
use App\Http\Requests\Articulo\UpdateArticuloRequest;

class UpdateArticuloController extends Controller
{
    private $repository;

    public function __construct(ArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateArticuloRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        if ($result) {
            return response()->json($result);
        }

        return response()->json([], 404);
    }
}
