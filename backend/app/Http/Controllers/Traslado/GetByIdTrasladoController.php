<?php
namespace App\Http\Controllers\Traslado;

use App\Http\Controllers\Controller;
use App\Repositories\Traslado\TrasladoRepository;

class GetByIdTrasladoController extends Controller
{
    private $repository;

    public function __construct(TrasladoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}