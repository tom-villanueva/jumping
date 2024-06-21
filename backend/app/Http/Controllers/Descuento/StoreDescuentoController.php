<?php
namespace App\Http\Controllers\Descuento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Descuento\DescuentoRepository;
use App\Http\Requests\Descuento\StoreDescuentoRequest;

class StoreDescuentoController extends Controller
{
    private $repository;

    public function __construct(DescuentoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreDescuentoRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}