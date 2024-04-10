<?php
namespace App\Http\Controllers\Equipo;

use App\Http\Controllers\Controller;
use App\Repositories\Equipo\EquipoRepository;

class GetEquiposController extends Controller
{
    private $repository;

    public function __construct(EquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
