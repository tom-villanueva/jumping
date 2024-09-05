<?php
namespace App\Http\Controllers\EquipoPrecio;

use App\Http\Controllers\Controller;
use App\Repositories\EquipoPrecio\EquipoPrecioRepository;
use App\Http\Requests\EquipoPrecio\UpdateEquipoPrecioRequest;
use App\Models\EquipoPrecio;
use App\Models\ReservaEquipoPrecio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateEquipoPrecioController extends Controller
{
    private $repository;

    public function __construct(EquipoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateEquipoPrecioRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $precioVigente = $this->repository->find($id);
            $precioEntrante = $request->only([
                'equipo_id',
                'precio',
                'fecha_desde',
            ]);

            $cambio = $precioEntrante['precio'] != $precioVigente->precio || 
                      $precioEntrante['fecha_desde'] != $precioVigente->fecha_desde;

            $cambioFechas = $precioEntrante['fecha_desde'] != $precioVigente->fecha_desde;

            $reservas = ReservaEquipoPrecio::where('equipo_precio_id', $id)
                ->count();

            $tieneReservasAsociadas = $reservas > 0;
            $updated_entity = $precioVigente;

            if($cambioFechas) {
                $previousEquipoPrecio = EquipoPrecio::where('equipo_id', $precioEntrante['equipo_id'])
                    ->where('fecha_hasta', '<=', $precioEntrante['fecha_desde'])
                    ->orderBy('fecha_hasta', 'desc')
                    ->first();

                $nextEquipoPrecio = EquipoPrecio::where('equipo_id', $precioEntrante['equipo_id'])
                    ->where('fecha_desde', '>', $precioEntrante['fecha_desde'])
                    ->orderBy('fecha_desde', 'asc')
                    ->first();
                
                if($previousEquipoPrecio ) {
                    $this->repository->update($previousEquipoPrecio->id, [
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
