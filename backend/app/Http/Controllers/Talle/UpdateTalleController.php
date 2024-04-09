<?php
namespace App\Http\Controllers\Talle;

use App\Http\Controllers\Controller;
use App\Repositories\Talle\TalleRepository;
use App\Http\Requests\Talle\UpdateTalleRequest;

class UpdateTalleController extends Controller
{
    private $repository;

    public function __construct(TalleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateTalleRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        if ($result) {
            return response()->json($result);
        }

        return response()->json([], 404);
    }
}
