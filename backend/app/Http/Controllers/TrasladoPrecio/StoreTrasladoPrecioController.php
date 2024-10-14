<?php
namespace App\Http\Controllers\TrasladoPrecio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TrasladoPrecio\TrasladoPrecioRepository;
use App\Http\Requests\TrasladoPrecio\StoreTrasladoPrecioRequest;
use App\Models\TrasladoPrecio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StoreTrasladoPrecioController extends Controller
{
    private $repository;

    public function __construct(TrasladoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreTrasladoPrecioRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = [
                ...$request->all(),
                "fecha_hasta" => null
            ];

            $ultimoTrasladoPrecio = TrasladoPrecio::whereNull('fecha_hasta')
                ->first();

            // SI SON IGUALES LAS FEHCA_DESDE, REEMPLAZO EL registro eliminando el anterior
            if(Carbon::parse($request->fecha_desde)->eq(Carbon::parse($ultimoTrasladoPrecio->fecha_desde))) {
                $this->repository->delete($ultimoTrasladoPrecio->id);
            } else {
                // Actualizo el último equipo precio para que termine un día antes
                // que comience el nuevo
                $this->repository->update($ultimoTrasladoPrecio->id, [
                    "fecha_hasta" => Carbon::parse($request->fecha_desde)->subDay()
                ]);
            }
            $new_entity = $this->repository->create($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($new_entity, 201);
    }
}