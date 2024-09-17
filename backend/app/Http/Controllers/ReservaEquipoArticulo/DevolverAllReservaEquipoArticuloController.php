<?php
namespace App\Http\Controllers\ReservaEquipoArticulo;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservaEquipoArticulo\DevolverAllReservaEquipoArticuloRequest;
use App\Models\ReservaEquipoArticulo;
use App\Repositories\ReservaEquipoArticulo\ReservaEquipoArticuloRepository;
use Illuminate\Support\Facades\DB;

class DevolverAllReservaEquipoArticuloController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DevolverAllReservaEquipoArticuloRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $reservaEquipoArticulos = ReservaEquipoArticulo::where('reserva_equipo_id', $id)
                ->get();

            foreach ($reservaEquipoArticulos as $reservaEquipoArticulo) {
                $this->repository->update($reservaEquipoArticulo->id, $request->all());
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json(true);
    }
}
