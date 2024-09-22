<?php
namespace App\Http\Controllers\Modelo;

use App\Http\Controllers\Controller;
use App\Repositories\Modelo\ModeloRepository;

class GetModeloController extends Controller
{
    private $repository;

    public function __construct(ModeloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
