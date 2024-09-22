<?php
namespace App\Http\Controllers\Modelo;

use App\Http\Controllers\Controller;
use App\Repositories\Modelo\ModeloRepository;

class GetByIdModeloController extends Controller
{
    private $repository;

    public function __construct(ModeloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}