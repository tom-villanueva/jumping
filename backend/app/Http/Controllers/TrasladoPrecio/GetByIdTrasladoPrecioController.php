<?php
namespace App\Http\Controllers\TrasladoPrecio;

use App\Http\Controllers\Controller;
use App\Repositories\TrasladoPrecio\TrasladoPrecioRepository;

class GetByIdTrasladoPrecioController extends Controller
{
    private $repository;

    public function __construct(TrasladoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}