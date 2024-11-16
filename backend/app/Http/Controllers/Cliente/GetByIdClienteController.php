<?php
namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Repositories\Cliente\ClienteRepository;

class GetByIdClienteController extends Controller
{
    private $repository;

    public function __construct(ClienteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}