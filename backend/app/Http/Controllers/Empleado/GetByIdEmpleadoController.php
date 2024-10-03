<?php
namespace App\Http\Controllers\Empleado;

use App\Http\Controllers\Controller;
use App\Repositories\Empleado\EmpleadoRepository;

class GetByIdEmpleadoController extends Controller
{
    private $repository;

    public function __construct(EmpleadoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}