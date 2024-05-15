<?php
namespace App\Http\Controllers\Descuento;

use App\Http\Controllers\Controller;
use App\Repositories\Descuento\DescuentoRepository;

class GetDescuentoByIdController extends Controller
{
    private $repository;

    public function __construct(DescuentoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}