<?php
namespace App\Http\Controllers\Articulo;

use App\Http\Controllers\Controller;
use App\Repositories\Articulo\ArticuloRepository;

class GetArticuloByIdController extends Controller
{
    private $repository;

    public function __construct(ArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}