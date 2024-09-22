<?php
namespace App\Http\Controllers\Articulo;

use App\Http\Controllers\Controller;
use App\Repositories\Articulo\ArticuloRepository;
use App\Http\Requests\Articulo\UpdateArticuloRequest;
use Illuminate\Support\Facades\DB;

class UpdateArticuloController extends Controller
{
    private $repository;

    public function __construct(ArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateArticuloRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $result = $this->repository->update($id, $request->all());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }    

        return response()->json($result);
    }
}
