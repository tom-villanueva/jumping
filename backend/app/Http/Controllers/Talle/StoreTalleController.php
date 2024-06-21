<?php
namespace App\Http\Controllers\Talle;

use App\Http\Controllers\Controller;
use App\Repositories\Talle\TalleRepository;
use App\Http\Requests\Talle\StoreTalleRequest;
use Illuminate\Support\Facades\DB;

class StoreTalleController extends Controller
{
    private $repository;

    public function __construct(TalleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreTalleRequest $request)
    {
        DB::beginTransaction();
        
        $new_entity = $this->repository->create($request->all());

        $tipo_articulos = $request->tipo_articulo_ids;

        if($tipo_articulos != null) {
            $new_entity->tipo_articulo_talle()->attach($tipo_articulos);
        }

        DB::commit();

        return response()->json($new_entity, 201);
    }
}