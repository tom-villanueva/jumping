<?php
namespace App\Http\Controllers\Articulo;

use App\Http\Controllers\Controller;
use App\Repositories\Articulo\ArticuloRepository;

class GetArticulosController extends Controller
{
    private $repository;

    public function __construct(ArticuloRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
