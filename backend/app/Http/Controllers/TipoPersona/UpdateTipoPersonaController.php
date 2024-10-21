<?php
namespace App\Http\Controllers\TipoPersona;

use App\Http\Controllers\Controller;
use App\Repositories\TipoPersona\TipoPersonaRepository;
use App\Http\Requests\TipoPersona\UpdateTipoPersonaRequest;

class UpdateTipoPersonaController extends Controller
{
    private $repository;

    public function __construct(TipoPersonaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateTipoPersonaRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}
