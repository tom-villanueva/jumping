<?php
namespace App\Http\Controllers\Traslado;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Traslado\TrasladoRepository;
use App\Http\Requests\Traslado\StoreTrasladoRequest;

class StoreTrasladoController extends Controller
{
    private $repository;

    public function __construct(TrasladoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreTrasladoRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}