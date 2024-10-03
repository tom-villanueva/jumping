<?php
namespace App\Http\Controllers\Empleado;

use App\Http\Controllers\Controller;
use App\Repositories\Empleado\EmpleadoRepository;

class GetEmpleadoController extends Controller
{
    private $repository;

    public function __construct(EmpleadoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
