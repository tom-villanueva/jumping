<?php
namespace App\Http\Controllers\Estado;

use App\Http\Controllers\Controller;
use App\Repositories\Estado\EstadoRepository;

class GetEstadoController extends Controller
{
    private $repository;

    public function __construct(EstadoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
