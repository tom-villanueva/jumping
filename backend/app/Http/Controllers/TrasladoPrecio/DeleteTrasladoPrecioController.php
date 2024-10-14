<?php
namespace App\Http\Controllers\TrasladoPrecio;

use App\Http\Controllers\Controller;
use App\Models\Traslado;
use App\Models\TrasladoPrecio;
use App\Repositories\TrasladoPrecio\TrasladoPrecioRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DeleteTrasladoPrecioController extends Controller
{
    private $repository;

    public function __construct(TrasladoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        DB::beginTransaction();

        try {
            $reservas = Traslado::where('traslado_precio_id', $id)
                ->count();
            
            $trasladoPrecio = $this->repository->find($id);
            $result = $trasladoPrecio;

            $precios = TrasladoPrecio::all();
           
            if($precios->count() == 1) {
                throw ValidationException::withMessages([
                    'traslado_precio_id' => 'Es el único precio asociado a traslados, modifíquelo poniendo misma fecha y nuevo precio.'
                ]);
            }

            $tieneReservasAsociadas = $reservas > 0;

            if($tieneReservasAsociadas) {
                // soft delete
                $this->repository->delete($id);
            } else {
                // hard delete
                DB::table('traslado_precio')
                    ->where('id', '=', $id)
                    ->delete();
            }

            $previousTrasladoPrecio = TrasladoPrecio::where('fecha_hasta', '<=', $trasladoPrecio->fecha_desde)
                ->orderBy('fecha_hasta', 'desc')
                ->first();

            $nextTrasladoPrecio = TrasladoPrecio::where('fecha_desde', '>', $trasladoPrecio->fecha_desde)
                ->orderBy('fecha_desde', 'asc')
                ->first();
            
            if ($previousTrasladoPrecio) {
                if ($nextTrasladoPrecio) {
                    // If there is a next one, set previous.fecha_hasta to one day before next.fecha_desde
                    $this->repository->update($previousTrasladoPrecio->id, [
                        'fecha_hasta' => Carbon::parse($nextTrasladoPrecio->fecha_desde)->subDay()
                    ]);
                } else {
                    // If there's no next one, set previous.fecha_hasta to null
                    $this->repository->update($previousTrasladoPrecio->id, [
                        'fecha_hasta' => null
                    ]);
                }
            }
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($result);
    }
}
