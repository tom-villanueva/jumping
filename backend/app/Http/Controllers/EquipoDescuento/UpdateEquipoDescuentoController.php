<?php
namespace App\Http\Controllers\EquipoDescuento;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipo\UpdateEquipoDescuentoRequest;
use App\Models\ReservaEquipoDescuento;
use App\Repositories\Equipo\EquipoDescuentoRepository;
use Illuminate\Support\Facades\DB;

class UpdateEquipoDescuentoController extends Controller
{
    private $repository;

    public function __construct(EquipoDescuentoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateEquipoDescuentoRequest $request, $equipo_descuento_id)
    {
        DB::beginTransaction();

        try {
            $descuentoVigente = $this->repository->find($equipo_descuento_id);
            $descuentoEntrante = $request->only([
                'equipo_id', 
                'descuento_id', 
                'dias'
            ]);

            // $cambioFechas = $this->checkCambioFechas($descuentoEntrante, $descuentoVigente);
            
            // $reservas = ReservaEquipoDescuento::where('equipo_descuento_id', $equipo_descuento_id)->count();

            // $tieneReservasAsociadas = $reservas > 0;
            // $updated_entity = $descuentoVigente;

            // if($cambioFechas && $tieneReservasAsociadas) {
            //     // soft delete
            //     $this->repository->delete($equipo_descuento_id);
            //     // attach nuevo
            //     $updated_entity = $this->repository->create($descuentoEntrante);
            // } else if($cambioFechas && !$tieneReservasAsociadas) {
            //     // sync de fechas
            //     $updated_entity = $this->repository->update($equipo_descuento_id, $descuentoEntrante);
            // }
            $updated_entity = $this->repository->update($equipo_descuento_id, $descuentoEntrante);


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($updated_entity);
    }

    private function checkCambioFechas($descuentoEntrante, $descuentoVigente) 
    {
        $cambioFechaDesde = $descuentoEntrante['fecha_desde'] != $descuentoVigente->fecha_desde; 
        $cambioFechaHasta = $descuentoEntrante['fecha_hasta'] != $descuentoVigente->fecha_hasta;
        
        return $cambioFechaDesde || $cambioFechaHasta;
    }
}