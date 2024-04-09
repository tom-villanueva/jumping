<?php
namespace App\Http\Controllers\TipoArticulo;

use App\Http\Controllers\Controller;
use App\Repositories\TipoArticuloRepository;
use App\Http\Requests\TipoArticulo\UpdateTipoArticuloRequest;

class UpdateTipoArticuloController extends Controller
{
    private $repository;

    public function __construct(TipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateTipoArticuloRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        if ($result) {
            return response()->json($result);
        }

        return response()->json([], 404);
    }
}
