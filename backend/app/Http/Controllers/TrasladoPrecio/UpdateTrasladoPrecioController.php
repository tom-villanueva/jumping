<?php
namespace App\Http\Controllers\TrasladoPrecio;

use App\Http\Controllers\Controller;
use App\Repositories\TrasladoPrecio\TrasladoPrecioRepository;
use App\Http\Requests\TrasladoPrecio\UpdateTrasladoPrecioRequest;
use App\Models\Traslado;
use App\Models\TrasladoPrecio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateTrasladoPrecioController extends Controller
{
    private $repository;

    public function __construct(TrasladoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateTrasladoPrecioRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $precioVigente = $this->repository->find($id);
            $precioEntrante = $request->only([
                'precio',
                'fecha_desde',
            ]);

            $cambio = $precioEntrante['precio'] != $precioVigente->precio || 
                      $precioEntrante['fecha_desde'] != $precioVigente->fecha_desde;

            $cambioFechas = $precioEntrante['fecha_desde'] != $precioVigente->fecha_desde;

            $reservas = Traslado::where('traslado_precio_id', $id)
                ->count();

            $tieneReservasAsociadas = $reservas > 0;
            $updated_entity = $precioVigente;

            if($cambioFechas) {
                $previousTrasladoPrecio = TrasladoPrecio::where('fecha_hasta', '<=', $precioEntrante['fecha_desde'])
                    ->orderBy('fecha_hasta', 'desc')
                    ->first();

                $nextTrasladoPrecio = TrasladoPrecio::where('fecha_desde', '>', $precioEntrante['fecha_desde'])
                    ->orderBy('fecha_desde', 'asc')
                    ->first();
                
                if($previousTrasladoPrecio ) {
                    $this->repository->update($previousTrasladoPrecio->id, [
                        'fecha_hasta' => Carbon::parse($precioEntrante['fecha_desde'])->subDay()->format('Y-m-d')
                    ]);
                }
            }

            if($cambio && $tieneReservasAsociadas) {
                // soft delete
                $this->repository->delete($id);
                // attach nuevo
                $updated_entity = $this->repository->create($precioEntrante);
            } else if($cambio && !$tieneReservasAsociadas) {
                // sync
                $updated_entity = $this->repository->update($id, $precioEntrante);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($updated_entity);
    }
}
