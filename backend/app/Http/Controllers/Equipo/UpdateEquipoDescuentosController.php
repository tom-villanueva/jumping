<?php
namespace App\Http\Controllers\Equipo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipo\UpdateEquipoDescuentosRequest;
use App\Repositories\Equipo\EquipoRepository;
use Illuminate\Support\Facades\DB;

class UpdateEquipoDescuentosController extends Controller
{
    private $repository;

    public function __construct(EquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateEquipoDescuentosRequest $request, $id)
    {
        DB::beginTransaction();

        $result = $this->repository->find($id);

        $descuentos = $request->descuentos_ids;

        $res = [];

        foreach($descuentos as $descuento) {
            $res[$descuento['descuento_id']] = [
                'fecha_desde' => $descuento['fecha_desde'],
                'fecha_hasta' => $descuento['fecha_hasta']
            ];
        }

        //TODO chequear con reservas

        $descuentos = $res;

        $result->equipo_descuento()->syncWithoutDetaching($descuentos);

        DB::commit();

        return response()->json($result);
    }
}
