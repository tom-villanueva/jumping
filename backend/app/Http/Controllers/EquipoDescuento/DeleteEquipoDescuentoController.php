<?php
namespace App\Http\Controllers\EquipoDescuento;

use App\Http\Controllers\Controller;
use App\Repositories\Equipo\EquipoDescuentoRepository;
use Illuminate\Support\Facades\DB;

class DeleteEquipoDescuentoController extends Controller
{
    private $repository;

    public function __construct(EquipoDescuentoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($equipo_descuento_id)
    {
        $descuento = $this->repository->find($equipo_descuento_id);
        $result = $descuento;
        $tieneReservasAsociadas = $descuento->tieneReservasAsociadas();
        
        if($tieneReservasAsociadas) {
          //soft delete
          $this->repository->delete($equipo_descuento_id);
        } else {
          // hard delete
          DB::table('equipo_descuento')
            ->where('id', '=', $equipo_descuento_id)
            ->delete();
        }

        return response()->json($result);
    }
}
