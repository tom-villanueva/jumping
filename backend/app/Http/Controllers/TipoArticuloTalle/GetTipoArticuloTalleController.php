<?php
namespace App\Http\Controllers\TipoArticuloTalle;

use App\Http\Controllers\Controller;
use App\Repositories\TipoArticuloTalle\TipoArticuloTalleRepository;

class GetTipoArticuloTalleController extends Controller
{
    private $repository;

    public function __construct(TipoArticuloTalleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
