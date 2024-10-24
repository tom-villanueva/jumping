<?php
namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Models\Traslado;
use App\Repositories\Reserva\ReservaRepository;
use Illuminate\Support\Facades\DB;

class DeleteReservaController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        // DB::beginTransaction();

        try {
            $reserva = $this->repository->find($id);

            $reservaEquipos = $reserva->equipos_reservados()->get();

            foreach ($reservaEquipos as $reservaEquipo) {
                foreach ($reservaEquipo->articulos as $reservaEquipoArticulo) {
                    $reservaEquipoArticulo->delete();
                }

                $reservaEquipo->delete();
            }

            // borrar traslados
            Traslado::where('reserva_id', $id)
                ->delete();

            $result = $this->repository->delete($id);

            // DB::commit();            
        } catch (\Throwable $th) {
            // DB::rollBack();
            throw $th;
        }

        return response()->json($result);
    }
}
