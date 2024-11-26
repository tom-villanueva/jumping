<?php
namespace App\Http\Controllers\TipoEquipo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TipoEquipo\TipoEquipoRepository;
use App\Http\Requests\TipoEquipo\StoreTipoEquipoRequest;

class StoreTipoEquipoController extends Controller
{
    private $repository;

    public function __construct(TipoEquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreTipoEquipoRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}