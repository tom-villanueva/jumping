<?php
namespace App\Http\Controllers\TrasladoAsiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TrasladoAsiento\TrasladoAsientoRepository;
use App\Http\Requests\TrasladoAsiento\StoreTrasladoAsientoRequest;
use App\Models\TrasladoAsiento;

class StoreTrasladoAsientoController extends Controller
{
    private $repository;

    public function __construct(TrasladoAsientoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreTrasladoAsientoRequest $request)
    {
        $trasladoPrecio = TrasladoAsiento::all()->first();

        if(!empty($trasladoPrecio)) {
            $new_entity = $trasladoPrecio->update($request->all());
        } else {
            $new_entity = $this->repository->create($request->all());
        }

        return response()->json($new_entity, 201);
    }
}