<?php
namespace App\Http\Controllers\Pago;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Pago\PagoRepository;
use App\Http\Requests\Pago\StorePagoRequest;

class StorePagoController extends Controller
{
    private $repository;

    public function __construct(PagoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StorePagoRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}