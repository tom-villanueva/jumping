<?php
namespace App\Http\Controllers\TipoPersona;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TipoPersona\TipoPersonaRepository;
use App\Http\Requests\TipoPersona\StoreTipoPersonaRequest;

class StoreTipoPersonaController extends Controller
{
    private $repository;

    public function __construct(TipoPersonaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreTipoPersonaRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}