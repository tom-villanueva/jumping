<?php
namespace App\Http\Controllers\TipoEquipo;

use App\Http\Controllers\Controller;
use App\Repositories\TipoEquipo\TipoEquipoRepository;

class GetTipoEquipoController extends Controller
{
    private $repository;

    public function __construct(TipoEquipoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
