<?php
namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Repositories\Cliente\ClienteRepository;

class GetClienteController extends Controller
{
    private $repository;

    public function __construct(ClienteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
