<?php
namespace App\Http\Controllers\Equipo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipo\UpdateEquipoDescuentosRequest;
use App\Repositories\Equipo\EquipoRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateEquipoDescuentosController extends Controller
{
    private $repository;

    public function __construct(EquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateEquipoDescuentosRequest $request, $id)
    {
        DB::beginTransaction();
        $equipo = $this->repository->find($id, [
            'include' => 'descuentos_vigentes'
        ]);

        $descuentos_vigentes = $equipo->descuentos_vigentes->toArray();

        //[{"descuento_id": 2, "fecha_desde": "2024-05-14", "fecha_hasta": "2024-05-30"}]
        $descuentos = $request->descuentos_ids;
        $descuentos_ids = array_column($descuentos, 'descuento_id');

        // Este foreach es para ver si hay que hacer soft delete
        foreach($descuentos_vigentes as $descuentoVigente) {
            $descuentoId = $descuentoVigente['id'];
            $existe = in_array($descuentoId, $descuentos_ids);

            if($existe) { // es porque lo quieren mantener, pero capaz le cambiaron la fecha
                $nuevoDescuento = $this->searchDescuentoById($descuentoId, $descuentos);
                $cambioFechas = $this->checkCambioFechas($descuentoVigente['pivot'], $nuevoDescuento);
                $tieneReservasAsociadas = $this->checkReservasAsociadas($descuentoVigente);

                if($cambioFechas && $tieneReservasAsociadas) {
                    // soft delete
                    $equipo->equipo_descuento()->updateExistingPivot($descuentoId, ['deleted_at' => Carbon::now()]);
                    // attach nuevo
                    $equipo->equipo_descuento()->attach($descuentoId, [
                        'fecha_desde' => $nuevoDescuento['fecha_desde'],
                        'fecha_hasta' => $nuevoDescuento['fecha_hasta']
                    ]);
                } else if($cambioFechas && !$tieneReservasAsociadas) {
                    // sync de fechas
                    $equipo->equipo_descuento()->updateExistingPivot($descuentoId, [
                        'fecha_desde' => $nuevoDescuento['fecha_desde'],
                        'fecha_hasta' => $nuevoDescuento['fecha_hasta']
                    ]);
                }
            } else { // es porque lo quieren borrar, pero capaz ya tiene reservas
                $tieneReservasAsociadas = $this->checkReservasAsociadas($descuentoVigente);

                if($tieneReservasAsociadas) {
                    // soft delete
                    $equipo->equipo_descuento()->updateExistingPivot($descuentoId, ['deleted_at' => Carbon::now()]);
                } else {
                    // hard delete
                    $equipo->equipo_descuento()->detach($descuentoId);
                }
            }
        }

        if(count($descuentos_vigentes) > 0) {
            $descuentos_vigentes_ids = array_column($descuentos_vigentes, 'id');
            foreach ($descuentos as $descuento) {
                if(!in_array($descuento['descuento_id'], $descuentos_vigentes_ids)) {
                    $equipo->equipo_descuento()->attach($descuento['descuento_id'], [
                        'fecha_desde' => $descuento['fecha_desde'],
                        'fecha_hasta' => $descuento['fecha_hasta']
                    ]);
                }
            }
        } else {
            foreach ($descuentos as $descuento) {
                $equipo->equipo_descuento()->attach($descuento['descuento_id'], [
                    'fecha_desde' => $descuento['fecha_desde'],
                    'fecha_hasta' => $descuento['fecha_hasta']
                ]);   
            }
        }

        DB::commit();

        return response()->json($equipo);
    }

    private function searchDescuentoById($id, $array) 
    {
        foreach ($array as $element) {
            if($element['descuento_id'] === $id) {
                return $element;
            }
        }

        return null;
    }

    private function checkCambioFechas($descuentoEntrante, $descuentoVigente) 
    {
        $cambioFechaDesde = $descuentoEntrante['fecha_desde'] != $descuentoVigente['fecha_desde']; 
        $cambioFechaHasta = $descuentoEntrante['fecha_hasta'] != $descuentoVigente['fecha_hasta'];

        return $cambioFechaDesde || $cambioFechaHasta;
    }

    private function checkReservasAsociadas($descuento) 
    {
        return true;
    }
}
