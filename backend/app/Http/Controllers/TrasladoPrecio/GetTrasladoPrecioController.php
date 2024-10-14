<?php
namespace App\Http\Controllers\TrasladoPrecio;

use App\Http\Controllers\Controller;
use App\Repositories\TrasladoPrecio\TrasladoPrecioRepository;

class GetTrasladoPrecioController extends Controller
{
    private $repository;

    public function __construct(TrasladoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
