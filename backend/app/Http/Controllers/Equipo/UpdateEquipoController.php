<?php
namespace App\Http\Controllers\Equipo;

use App\Http\Controllers\Controller;
use App\Repositories\Equipo\EquipoRepository;
use App\Http\Requests\Equipo\UpdateEquipoRequest;
use Illuminate\Support\Facades\DB;

class UpdateEquipoController extends Controller
{
    private $repository;

    public function __construct(EquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateEquipoRequest $request, $id)
    {
        DB::beginTransaction();

        $result = $this->repository->update($id, $request->all());

        $tipo_articulos = $request->tipo_articulo_ids;

        if($tipo_articulos !== null) {
            $tipo_articulos = array_column($tipo_articulos, 'tipo_articulo_id');
            
            $result->equipo_tipo_articulo()->sync($tipo_articulos);
        }

        DB::commit();

        return response()->json($result);
    }
}
