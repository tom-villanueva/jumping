<?php
namespace App\Http\Controllers\Equipo;

use App\Http\Controllers\Controller;
use App\Repositories\Equipo\EquipoRepository;
use App\Http\Requests\Equipo\UpdateEquipoRequest;

class UpdateEquipoController extends Controller
{
    private $repository;

    public function __construct(EquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateEquipoRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        if ($result) {
            return response()->json($result);
        }

        return response()->json([], 404);
    }
}
