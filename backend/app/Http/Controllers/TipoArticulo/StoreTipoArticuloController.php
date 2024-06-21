<?php
namespace App\Http\Controllers\TipoArticulo;

use App\Http\Controllers\Controller;
use App\Repositories\TipoArticulo\TipoArticuloRepository;
use App\Http\Requests\TipoArticulo\StoreTipoArticuloRequest;
use Illuminate\Support\Facades\DB;

class StoreTipoArticuloController extends Controller
{
    private $repository;

    public function __construct(TipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreTipoArticuloRequest $request)
    {
        DB::beginTransaction();

        $new_entity = $this->repository->create($request->all());

        $talles = $request->talle_ids;

        if($talles != null) {
            $new_entity->tipo_articulo_talle()->attach($talles);
        }

        $equipos = $request->equipo_ids;

        if($equipos != null) {
            $new_entity->equipo_tipo_articulo()->attach($equipos);
        }

        DB::commit();

        return response()->json($new_entity, 201);
    }
}