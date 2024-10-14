<?php

namespace App\Http\Controllers\TipoArticulo;

use App\Http\Controllers\Controller;
use App\Repositories\TipoArticulo\TipoArticuloRepository;
use App\Http\Requests\TipoArticulo\UpdateTipoArticuloRequest;
use App\Models\Articulo;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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

        try {
            $tipo = $this->repository->update($id, $request->all());

            $equipos = $request->equipo_ids;

            if ($equipos !== null) {
                $equipos = array_column($equipos, 'equipo_id');

                $tipo->equipo_tipo_articulo()->sync($equipos);
            }

            $talles = $request->talle_ids;

            if ($talles !== null) {
                // $res = [];
                $tallesActuales = $tipo->talles()->get()->toArray();
                $tallesActuales = array_column($tallesActuales, 'id');
                $talles = array_column($talles, 'talle_id');

                $tallesEliminar = array_diff($tallesActuales, $talles);

                if (count($tallesEliminar) > 0) {
                    $articulosAsociados = Articulo::where('tipo_articulo_id', $id)
                        ->whereIn('talle_id', $tallesEliminar)
                        ->get();

                    if (!empty($articulosAsociados)) {
                        throw ValidationException::withMessages([
                            'articulos_asociados' => 'Hay artículos asociados a los talles a eliminar.'
                        ]);
                    }
                }

                // foreach($talles as $talle) {
                //     $res[$talle['talle_id']] = ['stock' => $talle['stock']];
                // }

                // $talles = $res;

                $tipo->talles()->sync($talles);
            }

            $marcas = $request->marca_ids;

            if ($marcas !== null) {
                $marcasActuales = $tipo->marcas()->get()->toArray();
                $marcasActuales = array_column($marcasActuales, 'id');
                $marcas = array_column($marcas, 'marca_id');

                $marcasEliminar = array_diff($marcasActuales, $marcas);

                if (count($marcasEliminar) > 0) {
                    $articulosAsociados = Articulo::where('tipo_articulo_id', $id)
                        ->whereIn('marca_id', $marcasEliminar)
                        ->get();

                    if (!empty($articulosAsociados)) {
                        throw ValidationException::withMessages([
                            'articulos_asociados' => 'Hay artículos asociados a las marcas a eliminar.'
                        ]);
                    }
                }

                $tipo->marcas()->sync($marcas);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($tipo);
    }
}
