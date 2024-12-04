<?php
namespace App\Http\Controllers\ReservaEquipo;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipo\ReservaEquipoRepository;
use App\Http\Requests\ReservaEquipo\StoreReservaEquipoRequest;
use App\Repositories\Reserva\ReservaRepository;
use Illuminate\Support\Facades\DB;

class StoreReservaEquipoController extends Controller
{
    private $repository;
    private $reservaRepository;

    public function __construct(
        ReservaEquipoRepository $repository,
        ReservaRepository $reservaRepository
    )
    {
        $this->repository = $repository;
        $this->reservaRepository = $reservaRepository;
    }

    public function __invoke(StoreReservaEquipoRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = [
                ...$request->all(),
            ];

            $reserva_equipo = $this->repository->create($data);
            $reserva = $this->reservaRepository->find($request->reserva_id);

            $fechaDesde = $reserva->fecha_desde;
            $fechaHasta = $reserva->fecha_hasta;

            $reserva_equipo->storePreciosAndDescuentos($fechaDesde, $fechaHasta);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($reserva_equipo, 201);
    }
}
