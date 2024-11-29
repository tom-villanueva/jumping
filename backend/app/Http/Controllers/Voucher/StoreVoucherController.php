<?php
namespace App\Http\Controllers\Voucher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Voucher\VoucherRepository;
use App\Http\Requests\Voucher\StoreVoucherRequest;
use App\Models\EquipoVoucher;
use App\Models\ReservaEquipo;
use App\Models\TrasladoPrecioVoucher;
use Illuminate\Support\Facades\DB;

class StoreVoucherController extends Controller
{
    private $repository;

    public function __construct(VoucherRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreVoucherRequest $request)
    {
        DB::beginTransaction();

        try {
            $voucher = $this->repository->create($request->except(['equipos', 'traslados']));

            // son ReservaEquipo
            $equipos = $request->equipos;
            $reservaEquipoIds = array_column($request->reserva_equipo_ids, 'reserva_equipo_id');

            if(!empty($reservaEquipoIds)) {
                foreach ($reservaEquipoIds as $id) {
                    $reservaEquipo = ReservaEquipo::find($id);
                    
                    $reservaEquipoPrecio = $reservaEquipo->precios()->first();

                    EquipoVoucher::create([
                        'equipo_id' => $reservaEquipo->equipo_id,
                        'voucher_id' => $voucher->id,
                        'precio' => $reservaEquipoPrecio->precio
                    ]);
                }
            }

            // $traslados = $request->traslados;

            // if(!empty($traslados)) {
            //     foreach ($traslados as $traslado) {
            //         TrasladoPrecioVoucher::create([
            //             'traslado_precio_id' => ,
            //             'voucher_id' => $voucher->id,
            //         ]);
            //     }
            // }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($voucher, 201);
    }
}   