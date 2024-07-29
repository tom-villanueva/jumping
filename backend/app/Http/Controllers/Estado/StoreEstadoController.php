<?php
namespace App\Http\Controllers\Estado;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Estado\EstadoRepository;
use App\Http\Requests\Estado\StoreEstadoRequest;

class StoreEstadoController extends Controller
{
    private $repository;

    public function __construct(EstadoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreEstadoRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}