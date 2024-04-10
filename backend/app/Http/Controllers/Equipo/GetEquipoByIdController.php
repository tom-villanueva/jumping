<?php
namespace App\Http\Controllers\Equipo;

use App\Http\Controllers\Controller;
use App\Repositories\Equipo\EquipoRepository;

class GetEquipoByIdController extends Controller
{
    private $repository;

    public function __construct(EquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}