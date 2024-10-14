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

        try {
            $new_entity = $this->repository->create($request->all());

            $equipos = $request->equipo_ids;

            if ($equipos != null) {
                $new_entity->equipo_tipo_articulo()->attach($equipos);
            }

            $talles = $request->talle_ids;

            if ($talles != null) {
                $new_entity->talles()->attach($talles);
            }

            $marcas = $request->marca_ids;

            if ($marcas != null) {
                $new_entity->marcas()->attach($marcas);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($new_entity, 201);
    }
}
