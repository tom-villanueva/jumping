<?php
namespace App\Http\Controllers\TipoEquipo;

use App\Http\Controllers\Controller;
use App\Repositories\TipoEquipo\TipoEquipoRepository;
use App\Http\Requests\TipoEquipo\UpdateTipoEquipoRequest;

class UpdateTipoEquipoController extends Controller
{
    private $repository;

    public function __construct(TipoEquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateTipoEquipoRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}
