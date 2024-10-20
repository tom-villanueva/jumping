<?php
namespace App\Http\Controllers\ReservaEquipoArticulo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipoArticulo\ReservaEquipoArticuloRepository;
use App\Http\Requests\ReservaEquipoArticulo\StoreReservaEquipoArticuloRequest;
use App\Models\Articulo;
use App\Models\ReservaEquipoArticulo;
use Exception;

class StoreReservaEquipoArticuloController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreReservaEquipoArticuloRequest $request)
    {
        $articulo = Articulo::find($request->articulo_id);

        $inventario = $articulo->inventario()->first();

        if(!empty($inventario)) {
            $stockAlquilado = ReservaEquipoArticulo::where('articulo_id', $articulo->id)
                ->where('devuelto', false)
                ->count();

            if($inventario->stock == $stockAlquilado) {
                throw new Exception("No hay stock disponible.", 1);
            }
        }

        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}