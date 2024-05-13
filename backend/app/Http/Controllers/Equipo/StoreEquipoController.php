<?php
namespace App\Http\Controllers\Equipo;

use App\Http\Controllers\Controller;
use App\Repositories\Equipo\EquipoRepository;
use App\Http\Requests\Equipo\StoreEquipoRequest;
use App\Repositories\Equipo\EquipoPrecioRepository;
use Illuminate\Support\Facades\DB;

class StoreEquipoController extends Controller
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

    public function __invoke(StoreEquipoRequest $request)
    {
        DB::beginTransaction();

        $new_entity = $this->repository->create($request->all());

        $tipo_articulos = $request->tipo_articulo_ids;

        if($tipo_articulos != null) {
            $new_entity->equipo_tipo_articulo()->attach($tipo_articulos);
        }

        $equipoPrecio = [
            "equipo_id" => $new_entity->id,
            "precio" => $request->precio,
        ];

        $this->equipoPrecioRepository->create($equipoPrecio);

        DB::commit();

        return response()->json($new_entity);
    }
}