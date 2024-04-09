<?php
namespace App\Http\Controllers\Talle;

use App\Http\Controllers\Controller;
use App\Repositories\Talle\TalleRepository;

class GetTallesController extends Controller
{
    private $repository;

    public function __construct(TalleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
