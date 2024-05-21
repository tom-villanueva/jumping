<?php
namespace App\Http\Controllers\Equipo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipo\UpdateEquipoDescuentosRequest;
use App\Models\EquipoDescuento;
use App\Repositories\Equipo\EquipoRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UpdateEquipoDescuentosController extends Controller
{
    private $repository;

    public function __construct(EquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateEquipoDescuentosRequest $request, $id) 
    {
        DB::beginTransaction();

        $equipo = $this->repository->find($id, [
            'include' => 'descuentos_vigentes'
        ]);

        $descuentos_vigentes = $equipo->descuentos_vigentes->toArray();

        $descuentos_nuevos = $request->descuentos_ids;
        $descuentos_ids = array_column($descuentos_nuevos, 'id');

        try {
            foreach($descuentos_vigentes as $descuentoVigente) {
                $descuentoVigenteId = $descuentoVigente['pivot']['id'];
                $eliminar = !in_array($descuentoVigenteId, $descuentos_ids);

                if($eliminar) {
                    if($this->tieneReservasAsociadas($descuentoVigente)) {
                        // soft delete
                        DB::table('equipo_descuento')
                            ->where('id', '=', $descuentoVigenteId)
                            ->update([
                                "updated_at" => Carbon::now(),
                                'deleted_at' => Carbon::now()
                            ]);
                    } else {
                        // hard delete
                        DB::table('equipo_descuento')
                            ->where('id', '=', $descuentoVigenteId)
                            ->delete();
                    }
                }
            }

            foreach($descuentos_nuevos as $descuentoNuevo) {
                if(isset($descuentoNuevo['id'])) {
                    $descuentoActual = $this->searchDescuentoById($descuentoNuevo['id'], $descuentos_vigentes);
                    $cambioFechas = $this->checkCambioFechas($descuentoNuevo, $descuentoActual['pivot']);
                    $tieneReservasAsociadas = $this->tieneReservasAsociadas($descuentoNuevo);

                    if($cambioFechas) {
                        $solapaFechas = $this->solapaFechasPivot($equipo, $descuentoNuevo);

                        if($solapaFechas) {
                            //throw new Exception('Se solapan las fechas de algún descuento');
                            throw new HttpResponseException(
                                response()->json([
                                    'message' => "Se solapan las fechas de algún descuento",
                                    'errors' => []
                                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
                            );
                        }
                    }

                    if($cambioFechas && $tieneReservasAsociadas) {
                        // soft delete
                        DB::table('equipo_descuento')
                            ->where('id', '=', $descuentoNuevo['id'])
                            ->update([
                                "updated_at" => Carbon::now(),
                                'deleted_at' => Carbon::now()
                            ]);
                        // attach nuevo
                        DB::table('equipo_descuento')
                            ->insert([
                                'equipo_id' => $equipo->id,
                                'descuento_id' => $descuentoNuevo['descuento_id'], 
                                'fecha_desde' => $descuentoNuevo['fecha_desde'],
                                'fecha_hasta' => $descuentoNuevo['fecha_hasta'],
                                "created_at" =>  Carbon::now(),
                                "updated_at" => Carbon::now()
                            ]);
                    } else if($cambioFechas && !$tieneReservasAsociadas) {
                        // sync de fechas
                        DB::table('equipo_descuento')
                            ->where('id', '=', $descuentoNuevo['id'])
                            ->update([
                                'fecha_desde' => $descuentoNuevo['fecha_desde'],
                                'fecha_hasta' => $descuentoNuevo['fecha_hasta'],
                                "updated_at" => Carbon::now()
                            ]);
                    }
                } else {
                    $solapaFechas = $this->solapaFechas($equipo, $descuentoNuevo);

                    if($solapaFechas) {
                        //throw new Exception('Se solapan las fechas de algún descuento');
                        throw new HttpResponseException(
                            response()->json([
                                'message' => "Se solapan las fechas de algún descuento",
                                'errors' => []
                            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
                        );
                    }

                    $equipo->equipo_descuento()->attach($descuentoNuevo['descuento_id'], [
                        'fecha_desde' => $descuentoNuevo['fecha_desde'],
                        'fecha_hasta' => $descuentoNuevo['fecha_hasta']
                    ]);
                }
            }

            DB::commit();
            // EquipoDescuento::truncate();
            return response()->json($equipo);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function searchDescuentoById($id, $array) 
    {
        foreach ($array as $element) {
            if($element['pivot']['id'] === $id) {
                return $element;
            }
        }

        return null;
    }

    private function checkCambioFechas($descuentoEntrante, $descuentoVigente) 
    {
        $cambioFechaDesde = $descuentoEntrante['fecha_desde'] != $descuentoVigente['fecha_desde']; 
        $cambioFechaHasta = $descuentoEntrante['fecha_hasta'] != $descuentoVigente['fecha_hasta'];

        return $cambioFechaDesde || $cambioFechaHasta;
    }

    /*
    If we have two date ranges [x1, y1] & [x2, y2], they can overlap in 4 ways:

    1. ([)] -> x1 <= x2 && y1 >= x2
    2. [(]) -> x1 <= y2 && y1 >= y2
    3. [()] -> x1 >= x2 && y1 <= y2
    4. ([]) -> x1 <= x2 && y1 >= y2
    */
    private function solapaFechas($equipo, $descuento)
    {
        $solapados = DB::table('equipo_descuento')
            ->where('equipo_id', $equipo->id)
            ->whereNull('deleted_at')
            ->where(function (Builder $query) use($descuento) {
                $query->whereDate('fecha_desde', '>=', $descuento['fecha_desde'])
                      ->whereDate('fecha_desde', '<=', $descuento['fecha_hasta'])
                ->orWhere(function (Builder $query) use($descuento) {
                    $query->whereDate('fecha_hasta', '>=', $descuento['fecha_desde'])
                          ->whereDate('fecha_hasta', '<=', $descuento['fecha_hasta']);
                })
                ->orWhere(function (Builder $query) use($descuento) {
                    $query->whereDate('fecha_desde', '<=', $descuento['fecha_desde'])
                          ->whereDate('fecha_hasta', '>=', $descuento['fecha_hasta']);
                })
                ->orWhere(function (Builder $query) use($descuento) {
                    $query->whereDate('fecha_desde', '>=', $descuento['fecha_desde'])
                          ->whereDate('fecha_hasta', '<=', $descuento['fecha_hasta']);
                });
            });

            // if($descuento['descuento_id'] == 4) {
            //     dd($descuento['fecha_desde'], $descuento['fecha_hasta'], $solapados->get());
            // }
        
        return $solapados->count() >= 1;
    }

    private function solapaFechasPivot($equipo, $descuento)
    {
        $solapados = DB::table('equipo_descuento')
            ->where('equipo_id', '=', $equipo->id)
            ->whereNot('id', $descuento['id']) // para evitar que se solape con él mismo
            ->whereNotNull('deleted_at')
            ->where(function (Builder $query) use($descuento) {
                $query->where(function (Builder $query) use($descuento) {
                    $query->whereDate('fecha_desde', '>=', $descuento['fecha_desde'])
                          ->whereDate('fecha_desde', '<=', $descuento['fecha_hasta']);
                })
                ->orWhere(function (Builder $query) use($descuento) {
                    $query->whereDate('fecha_hasta', '>=', $descuento['fecha_desde'])
                          ->whereDate('fecha_hasta', '<=', $descuento['fecha_hasta']);
                })
                ->orWhere(function (Builder $query) use($descuento) {
                    $query->whereDate('fecha_desde', '<=', $descuento['fecha_desde'])
                          ->whereDate('fecha_hasta', '>=', $descuento['fecha_hasta']);
                })
                ->orWhere(function (Builder $query) use($descuento) {
                    $query->whereDate('fecha_desde', '>=', $descuento['fecha_desde'])
                          ->whereDate('fecha_hasta', '<=', $descuento['fecha_hasta']);
                });
            })
            ->count();
        
        return $solapados >= 1;
    }

    private function tieneReservasAsociadas($descuento) 
    {
        // if($descuento['id'] == 5) {
        //     return true;
        // }
        return false;
    }
}
