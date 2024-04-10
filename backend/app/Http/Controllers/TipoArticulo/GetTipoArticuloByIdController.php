<?php
namespace App\Http\Controllers\TipoArticulo;

use App\Http\Controllers\Controller;
use App\Repositories\TipoArticulo\TipoArticuloRepository;

class GetTipoArticuloByIdController extends Controller
{
    private $repository;

    public function __construct(TipoArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}