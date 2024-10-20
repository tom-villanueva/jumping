<?php
namespace App\Http\Controllers\Articulo;

use App\Http\Controllers\Controller;
use App\Repositories\Articulo\ArticuloRepository;
use App\Http\Requests\Articulo\StoreArticuloRequest;
use App\Models\Articulo;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;

class StoreArticuloController extends Controller
{
    private $repository;

    public function __construct(
        ArticuloRepository $repository, 
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreArticuloRequest $request)
    {
        DB::beginTransaction();

        try {
            if($request->es_generico) {
                $new_entity = new Articulo([
                    'descripcion' => $request->descripcion,
                    'codigo' => $request->codigo,
                    'observacion' => $request->observacion,
                    'tipo_articulo_id' => $request->tipo_articulo_id,
                    'talle_id' => $request->talle_id,
                    'marca_id' => $request->marca_id,
                    'modelo_id' => $request->modelo_id,
                    'nro_serie' => $request->nro_serie,
                    'disponible' => $request->disponible
                ]);

                $new_entity->saveQuietly();

                Inventario::create([
                    'tipo_articulo_id' => $request->tipo_articulo_id,
                    'talle_id' => $request->talle_id,
                    'marca_id' => $request->marca_id,
                    'modelo_id' => $request->modelo_id,
                    'articulo_id' => $new_entity->id,
                    'stock' => $request->stock,
                ]);

            } else {
                $new_entity = $this->repository->create($request->except(['es_generico', 'stock']));
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($new_entity, 201);
    }
}