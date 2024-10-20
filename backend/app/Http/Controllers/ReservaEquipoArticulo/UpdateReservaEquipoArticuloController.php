<?php
namespace App\Http\Controllers\ReservaEquipoArticulo;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipoArticulo\ReservaEquipoArticuloRepository;
use App\Http\Requests\ReservaEquipoArticulo\UpdateReservaEquipoArticuloRequest;
use App\Models\Articulo;
use App\Models\ReservaEquipoArticulo;
use Exception;

class UpdateReservaEquipoArticuloController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateReservaEquipoArticuloRequest $request, $id)
    {
        $articulo = Articulo::find($request->articulo_id);

        $inventario = $articulo->inventario()->first();

        // si no es genérico y quiero de-devolver
        if(!$request->devuelto && empty($inventario)) {
            // si hay un reserva equipo articulo con ese articulo, y
            // no está devuelto, entonces no puedo volver a ponerlo true
            $reservaEquipoArticulo = ReservaEquipoArticulo::where('articulo_id', $request->articulo_id)
                ->where('devuelto', false)
                ->where('id', '!=', $id)
                ->first();
            
            if(!empty($reservaEquipoArticulo)) {
                throw new Exception("No se puede devolver porque está alquilado en otro equipo.", 1);
            }
        } else if(!$request->devuelto && !empty($inventario)) {
            $stockAlquilado = ReservaEquipoArticulo::where('articulo_id', $articulo->id)
                ->where('devuelto', false)
                ->count();

            if($inventario->stock < $stockAlquilado + 1) {
                throw new Exception("No hay stock disponible.", 1);
            }
        }
 
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}
