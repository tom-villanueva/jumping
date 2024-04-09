<?php
namespace App\Http\Controllers\Talle;

use App\Http\Controllers\Controller;
use App\Repositories\Talle\TalleRepository;

class GetTalleByIdController extends Controller
{
    private $repository;

    public function __construct(TalleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->find($id);
       
        return response()->json($result);
    }
}