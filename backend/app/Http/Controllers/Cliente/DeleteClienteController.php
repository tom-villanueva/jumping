<?php
namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Repositories\Cliente\ClienteRepository;

class DeleteClienteController extends Controller
{
    private $repository;

    public function __construct(ClienteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}
