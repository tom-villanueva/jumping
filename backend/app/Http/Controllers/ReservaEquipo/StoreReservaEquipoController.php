<?php
namespace App\Http\Controllers\ReservaEquipo;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipo\ReservaEquipoRepository;
use App\Http\Requests\ReservaEquipo\StoreReservaEquipoRequest;
use App\Repositories\Equipo\EquipoRepository;
use Illuminate\Support\Facades\DB;

class StoreReservaEquipoController extends Controller
{
    private $repository;
    private $equipoRepository;

    public function __construct(
        ReservaEquipoRepository $repository,
        EquipoRepository $equipoRepository,
    )
    {
        $this->repository = $repository;
        $this->equipoRepository = $equipoRepository;
    }

    public function __invoke(StoreReservaEquipoRequest $request)
    {
        DB::beginTransaction();

        try {
            $equipo = $this->equipoRepository->find($request->equipo_id);

            $equipo_precio_id = $equipo->precio_vigente->id;
            
            $equipo_descuento_id = $equipo->descuentos_vigentes()->get()->isNotEmpty() 
                ? $equipo->descuentos_vigentes()->first()->id 
                : null;

            $data = [
                ...$request->all(),
                'equipo_precio_id' => $equipo_precio_id,
                'equipo_descuento_id' => $equipo_descuento_id
            ];

            $new_entity = $this->repository->create($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($new_entity, 201);
    }
}