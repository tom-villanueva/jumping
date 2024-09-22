<?php
namespace App\Http\Controllers\Modelo;

use App\Http\Controllers\Controller;
use App\Repositories\Modelo\ModeloRepository;
use App\Http\Requests\Modelo\UpdateModeloRequest;
use App\Models\Articulo;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;

class UpdateModeloController extends Controller
{
    private $repository;

    public function __construct(ModeloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateModeloRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $modelo = $this->repository->find($id);

            $newMarcaId = $request->marca_id;
            $oldMarcaId = $modelo->marca_id;

            // Only proceed if marca_id has changed
            if ($newMarcaId != $oldMarcaId) {
                // Get all related Articulo records
                $articulos = Articulo::where('modelo_id', $modelo->id)
                    ->where('marca_id', $oldMarcaId)
                    ->get();

                foreach ($articulos as $articulo) {
                    // Update the marca_id in the Articulo record
                    $articulo->marca_id = $newMarcaId;
                    DB::afterCommit(function () use($articulo) {
                        $articulo->save(); // This will automatically trigger the observer
                    });
                }
                
                // Update the marca_id in the Inventario records
                DB::afterCommit(function () use($modelo, $oldMarcaId){
                    Inventario::where('modelo_id', $modelo->id)
                        ->where('marca_id', $oldMarcaId)
                        ->delete();
                });
            }

            // Finally, update the marca_id in the Modelo table
            $result = $this->repository->update($id, $request->all());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($result);
    }
}
