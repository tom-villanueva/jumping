<?php
namespace App\Http\Controllers\Talle;

use App\Http\Controllers\Controller;
use App\Repositories\Talle\TalleRepository;
use App\Http\Requests\Talle\UpdateTalleRequest;
use Illuminate\Support\Facades\DB;

class UpdateTalleController extends Controller
{
    private $repository;

    public function __construct(TalleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateTalleRequest $request, $id)
    {
        DB::beginTransaction();

        $result = $this->repository->update($id, $request->all());

        $tipo_articulos = $request->tipo_articulo_ids;

        if($tipo_articulos !== null) {
            $tipo_articulos = array_column($tipo_articulos, 'tipo_articulo_id');
            
            $result->tipo_articulo_talle()->sync($tipo_articulos);
        }

        DB::commit();

        return response()->json($result);
    }
}
