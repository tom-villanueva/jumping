<?php
namespace App\Http\Controllers\Articulo;

use App\Http\Controllers\Controller;
use App\Repositories\Articulo\ArticuloRepository;
use App\Http\Requests\Articulo\UpdateArticuloRequest;
use App\Models\Inventario;
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
        // DB::beginTransaction();

        try {
            $articulo = $this->repository->find($id);

            $inventario = $articulo->inventario()->first();

            if(!empty($inventario)) {
                $articulo->updateQuietly($request->all());
                $result = $articulo;

                $fieldsToCheck = ['tipo_articulo_id', 'talle_id', 'marca_id', 'modelo_id'];
                
                if($articulo->wasChanged($fieldsToCheck)) {
                    $stock = $inventario->stock;
                    $inventario->delete();

                    Inventario::create([
                        'tipo_articulo_id' => $articulo->tipo_articulo_id, 
                        'talle_id' => $articulo->talle_id, 
                        'marca_id' => $articulo->marca_id, 
                        'modelo_id' => $articulo->modelo_id,
                        'articulo_id' => $articulo->id,
                        'stock' => $stock
                    ]);
                }
            } else {
                $result = $this->repository->update($id, $request->all());
            }

            // DB::commit();
        } catch (\Throwable $th) {
            // DB::rollBack();
            throw $th;
        }    

        return response()->json($result);
    }
}
