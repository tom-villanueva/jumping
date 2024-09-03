<?php
namespace App\Http\Controllers\EquipoPrecio;

use App\Http\Controllers\Controller;
use App\Repositories\EquipoPrecio\EquipoPrecioRepository;

class GetEquipoPrecioController extends Controller
{
    private $repository;

    public function __construct(EquipoPrecioRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
