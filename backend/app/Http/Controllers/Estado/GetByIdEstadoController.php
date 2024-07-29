<?php
namespace App\Http\Controllers\Estado;

use App\Http\Controllers\Controller;
use App\Repositories\Estado\EstadoRepository;

class GetByIdEstadoController extends Controller
{
    private $repository;

    public function __construct(EstadoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}