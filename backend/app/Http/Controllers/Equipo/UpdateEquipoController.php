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

        $result = $this->repository->update($id, $request->all());

        $tipo_articulos = $request->tipo_articulo_ids;

        if($tipo_articulos !== null) {
            $tipo_articulos = array_column($tipo_articulos, 'tipo_articulo_id');
            
            $result->equipo_tipo_articulo()->sync($tipo_articulos);
        }

        // agarro el último precio vigente
        $equipoPrecio = EquipoPrecio::where('equipo_id', '=', $result->id)
            ->whereDate('created_at', '<=', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->first();

        if($equipoPrecio->precio != $request->precio) {

            $newEquipoPrecio = [
                "equipo_id" => $result->id,
                "precio" => $request->precio
            ];

            $this->equipoPrecioRepository->create($newEquipoPrecio);
        }

        DB::commit();

        return response()->json($result);
    }
}
