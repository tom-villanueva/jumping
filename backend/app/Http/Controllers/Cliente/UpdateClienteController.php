<?php
namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Repositories\Cliente\ClienteRepository;
use App\Http\Requests\Cliente\UpdateClienteRequest;

class UpdateClienteController extends Controller
{
    private $repository;

    public function __construct(ClienteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateClienteRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}
