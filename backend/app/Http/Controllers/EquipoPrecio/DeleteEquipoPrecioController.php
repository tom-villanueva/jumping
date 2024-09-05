<?php
namespace App\Http\Controllers\EquipoPrecio;

use App\Http\Controllers\Controller;
use App\Models\ReservaEquipoPrecio;
use App\Repositories\EquipoPrecio\EquipoPrecioRepository;
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

            // if($reservas > 0) {
            //     throw ValidationException::withMessages([
            //         'reserva_equipo_precio_id' => 'El precio ya tiene reservas asociadas tiene reservas asociadas.'
            //     ]);
            // }
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

            $result = $this->repository->delete($id);
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($result);
    }
}
