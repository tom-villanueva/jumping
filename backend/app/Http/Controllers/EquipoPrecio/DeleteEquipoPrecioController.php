<?php
namespace App\Http\Controllers\EquipoPrecio;

use App\Http\Controllers\Controller;
use App\Models\EquipoPrecio;
use App\Models\ReservaEquipoPrecio;
use App\Repositories\EquipoPrecio\EquipoPrecioRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DeleteEquipoPrecioController extends Controller
{
    private $repository;

    public function __construct(EquipoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        DB::beginTransaction();

        try {
            $reservas = ReservaEquipoPrecio::where('equipo_precio_id', $id)
                ->count();
            
            $equipoPrecio = $this->repository->find($id);
            $result = $equipoPrecio;

            $precios = EquipoPrecio::where('equipo_id', '=', $equipoPrecio->equipo_id);
           
            if($precios->count() == 1) {
                throw ValidationException::withMessages([
                    'reserva_equipo_precio_id' => 'Es el único precio asociado a este equipo, modifíquelo.'
                ]);
            }

            $tieneReservasAsociadas = $reservas > 0;

            if($tieneReservasAsociadas) {
                // soft delete
                $this->repository->delete($id);
            } else {
                // hard delete
                DB::table('equipo_precio')
                    ->where('id', '=', $id)
                    ->delete();
            }

            $previousEquipoPrecio = EquipoPrecio::where('equipo_id', $equipoPrecio->equipo_id)
                ->where('fecha_hasta', '<=', $equipoPrecio->fecha_desde)
                ->orderBy('fecha_hasta', 'desc')
                ->first();

            $nextEquipoPrecio = EquipoPrecio::where('equipo_id', $equipoPrecio->equipo_id)
                ->where('fecha_desde', '>', $equipoPrecio->fecha_desde)
                ->orderBy('fecha_desde', 'asc')
                ->first();
            
            if ($previousEquipoPrecio) {
                if ($nextEquipoPrecio) {
                    // If there is a next one, set previous.fecha_hasta to one day before next.fecha_desde
                    $this->repository->update($previousEquipoPrecio->id, [
                        'fecha_hasta' => Carbon::parse($nextEquipoPrecio->fecha_desde)->subDay()
                    ]);
                } else {
                    // If there's no next one, set previous.fecha_hasta to null
                    $this->repository->update($previousEquipoPrecio->id, [
                        'fecha_hasta' => null
                    ]);
                }
            }
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($result);
    }
}
