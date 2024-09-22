<?php
namespace App\Http\Controllers\Articulo;

use App\Http\Controllers\Controller;
use App\Repositories\Articulo\ArticuloRepository;
use App\Http\Requests\Articulo\StoreArticuloRequest;
use Illuminate\Support\Facades\DB;

class StoreArticuloController extends Controller
{
    private $repository;

    public function __construct(
        ArticuloRepository $repository, 
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreArticuloRequest $request)
    {
        DB::beginTransaction();

        try {
            $new_entity = $this->repository->create($request->all());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($new_entity, 201);
    }
}