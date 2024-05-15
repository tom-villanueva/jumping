<?php
namespace App\Http\Controllers\Descuento;

use App\Http\Controllers\Controller;
use App\Repositories\Descuento\DescuentoRepository;

class GetDescuentosController extends Controller
{
    private $repository;

    public function __construct(DescuentoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
