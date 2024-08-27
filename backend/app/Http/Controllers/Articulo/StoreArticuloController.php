<?php
namespace App\Http\Controllers\Articulo;

use App\Http\Controllers\Controller;
use App\Repositories\Articulo\ArticuloRepository;
use App\Http\Requests\Articulo\StoreArticuloRequest;
use App\Models\TipoArticuloTalle;
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
            $tipoArticuloTalle = TipoArticuloTalle::where('tipo_articulo_id', $request->tipo_articulo_id)
                                                ->where('talle_id', $request->talle_id)
                                                ->first();

            $data = [
                ...$request->except(['tipo_articulo_id', 'talle_id']),
                'tipo_articulo_talle_id' => $tipoArticuloTalle->id,
            ];

            $new_entity = $this->repository->create($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($new_entity, 201);
    }
}