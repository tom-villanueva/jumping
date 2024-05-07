<?php
namespace App\Http\Controllers\TipoArticulo;

use App\Http\Controllers\Controller;
use App\Repositories\TipoArticulo\TipoArticuloRepository;
use App\Http\Requests\TipoArticulo\UpdateTipoArticuloRequest;
use Illuminate\Support\Facades\DB;

class UpdateTipoArticuloController extends Controller
{
    private $repository;

    public function __construct(TipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateTipoArticuloRequest $request, $id)
    {
        DB::beginTransaction();

        $result = $this->repository->update($id, $request->all());

        $talles = $request->talle_ids;

        if($talles !== null) {
            $res = [];

            foreach($talles as $talle) {
                $res[$talle['talle_id']] = ['stock' => $talle['stock']];
            }

            $talles = $res;
            
            $result->tipo_articulo_talle()->sync($talles);
        }

        $equipos = $request->equipo_ids;

        if($equipos !== null) {
            $equipos = array_column($equipos, 'equipo_id');

            $result->equipo_tipo_articulo()->sync($equipos);
        }

        DB::commit();

        return response()->json($result);
    }
}
