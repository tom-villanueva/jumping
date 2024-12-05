<?php

namespace App\Http\Controllers\Voucher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Voucher\StoreReservaDesdeVoucherRequest;
use App\Models\ReservaEquipo;
use App\Models\ReservaEstado;
use App\Repositories\Voucher\VoucherRepository;
use App\Repositories\Reserva\ReservaRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StoreReservaDesdeVoucherController extends Controller
{
    private $repository;
    private $reservaRepository;

    public function __construct(VoucherRepository $repository, ReservaRepository $reservaRepository)
    {
        $this->repository = $repository;
        $this->reservaRepository = $reservaRepository;
    }

    public function __invoke(StoreReservaDesdeVoucherRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $voucher = $this->repository->find($id);

            if($voucher->reserva_id) {
                throw ValidationException::withMessages([
                    'voucher_usado' => 'El voucher ya fue utilizado.'
                ]);
            }

            $reserva = $this->reservaRepository->create([
                'fecha_prueba' => $request->fecha_prueba,
                'fecha_desde' => $request->fecha_desde,
                'fecha_hasta' => $request->fecha_hasta,
                'cliente_id' => $voucher->cliente_id,
            ]);

            ReservaEstado::create([
                'reserva_id' => $reserva->id,
                'estado_id' => 1
            ]);

            $voucher->update([
                'reserva_id' => $reserva->id
            ]);

            $equipos = $voucher->equipo_voucher()->get();

            foreach ($equipos as $equipoVoucher) {
                $equipo = $equipoVoucher->equipo;

                if (empty($equipo)) {
                    return response()->json([
                        'error' => 'Ocurrió un error al crear la reserva.',
                        'message' => 'Uno de los equipos ya no existe.'
                    ], 500);
                }

                $reservaEquipo = ReservaEquipo::create([
                    'reserva_id' => $reserva->id,
                    'equipo_id' => $equipo->id,
                ]);

                $fechaDesde = $reserva->fecha_desde;
                $fechaHasta = $reserva->fecha_hasta;

                $reservaEquipo->storePreciosAndDescuentos($fechaDesde, $fechaHasta);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($reserva);
    }
}
