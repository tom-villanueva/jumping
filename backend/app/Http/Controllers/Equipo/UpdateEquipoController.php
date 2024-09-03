<?php
namespace App\Http\Controllers\Equipo;

use App\Http\Controllers\Controller;
use App\Repositories\Equipo\EquipoRepository;
use App\Http\Requests\Equipo\UpdateEquipoRequest;
use App\Models\EquipoPrecio;
use App\Repositories\Equipo\EquipoPrecioRepository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateEquipoController extends Controller
{
    private $repository;
    private $equipoPrecioRepository;

    public function __construct(
        EquipoRepository $repository,
        EquipoPrecioRepository $equipoPrecioRepository
    )
    {
        $this->repository = $repository;
        $this->equipoPrecioRepository = $equipoPrecioRepository;
    }

    public function __invoke(UpdateEquipoRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->update($id, $request->all());

            $tipo_articulos = $request->tipo_articulo_ids;

            if($tipo_articulos !== null) {
                $tipo_articulos = array_column($tipo_articulos, 'tipo_articulo_id');
                
                $result->equipo_tipo_articulo()->sync($tipo_articulos);
            }

            // agarro el último precio vigente
            $equipoPrecio = EquipoPrecio::where('equipo_id', '=', $result->id)
                ->whereNull('fecha_hasta')
                ->first();

            if($equipoPrecio->precio != $request->precio) {

                $today = Carbon::now()->format('Y-m-d');
                $fechaDesde = Carbon::now()->addDay()->format('Y-m-d');

                $newEquipoPrecio = [
                    "equipo_id" => $result->id,
                    "precio" => $request->precio,
                    "fecha_desde" => $fechaDesde,
                    "fecha_hasta" => null
                ];

                $this->equipoPrecioRepository->update($equipoPrecio->id, [
                    "fecha_hasta" => $today 
                ]);

                $this->equipoPrecioRepository->create($newEquipoPrecio);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        

        return response()->json($result);
    }
}
