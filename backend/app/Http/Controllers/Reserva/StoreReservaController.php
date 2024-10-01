<?php
namespace App\Http\Controllers\Reserva;

use App\Http\Controllers\Controller;
use App\Repositories\Reserva\ReservaRepository;
use App\Http\Requests\Reserva\StoreReservaRequest;
use App\Models\ReservaEstado;
use Illuminate\Support\Facades\DB;

class StoreReservaController extends Controller
{
    private $repository;

    public function __construct(ReservaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreReservaRequest $request)
    {
        DB::beginTransaction();

        try {
            $reserva = $this->repository->create($request->all());

            ReservaEstado::create([
                'reserva_id' => $reserva->id,
                'estado_id' => 1
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($reserva, 201);
    }
}