<?php
namespace App\Http\Controllers\EquipoPrecio;

use App\Http\Controllers\Controller;
use App\Repositories\EquipoPrecio\EquipoPrecioRepository;
use App\Http\Requests\EquipoPrecio\StoreEquipoPrecioRequest;
use App\Models\EquipoPrecio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StoreEquipoPrecioController extends Controller
{
    private $repository;

    public function __construct(EquipoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreEquipoPrecioRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = [
                ...$request->all(),
                "fecha_hasta" => null
            ];

            $new_entity = $this->repository->create($data);

            // Actualizo el último equipo precio para que termine un día antes
            // que comience el nuevo
            $ultimoEquipoPrecio = EquipoPrecio::where('equipo_id', '=', $request->equipo_id)
                ->whereNull('fecha_hasta')
                ->first();

            $this->repository->update($ultimoEquipoPrecio->id, [
                "fecha_hasta" => Carbon::parse($request->fecha_desde)->subDay()
            ]);
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($new_entity, 201);
    }
}