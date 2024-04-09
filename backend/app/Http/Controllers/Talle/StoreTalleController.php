<?php
namespace App\Http\Controllers\Talle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Talle\TalleRepository;
use App\Http\Requests\Talle\StoreTalleRequest;

class StoreTalleController extends Controller
{
    private $repository;

    public function __construct(TalleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreTalleRequest $request)
    {
        $new_entity = $this->repository->create($request->all());

        return response()->json($new_entity);
    }
}