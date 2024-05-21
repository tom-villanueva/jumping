<?php
namespace App\Http\Controllers\EquipoDescuento;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipo\StoreEquipoDescuentoRequest;
use App\Repositories\Equipo\EquipoDescuentoRepository;
use Illuminate\Support\Facades\DB;

class StoreEquipoDescuentoController extends Controller
{
    private $repository;

    public function __construct(EquipoDescuentoRepository $repository,)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreEquipoDescuentoRequest $request)
    {
        DB::beginTransaction();

        try {
            $new_entity = $this->repository->create($request->all());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($new_entity);
    }
}