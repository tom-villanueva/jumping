<?php
namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Cliente\ClienteRepository;
use App\Http\Requests\Cliente\StoreClienteRequest;

class StoreClienteController extends Controller
{
    private $repository;

    public function __construct(ClienteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreClienteRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity, 201);
    }
}