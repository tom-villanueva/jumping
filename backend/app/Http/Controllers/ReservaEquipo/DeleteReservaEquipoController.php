<?php
namespace App\Http\Controllers\ReservaEquipo;

use App\Http\Controllers\Controller;
use App\Repositories\ReservaEquipo\ReservaEquipoRepository;
use Illuminate\Support\Facades\DB;

class DeleteReservaEquipoController extends Controller
{
    private $repository;

    public function __construct(ReservaEquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        // DB::beginTransaction();

        try {
            $reservaEquipo = $this->repository->find($id);

            foreach ($reservaEquipo->articulos as $reservaEquipoArticulo) {
                // dd($reservaEquipoArticulo);
                // $articulo = $reservaEquipoArticulo->articulo()->first();

                // $articulo->disponible = true;
                // $articulo->save();
                $reservaEquipoArticulo->delete();
            }

            $result = $this->repository->delete($id);

            // DB::commit();
        } catch (\Throwable $th) {
            // DB::rollBack();
            throw $th;
        }

        return response()->json($result);
    }
}
