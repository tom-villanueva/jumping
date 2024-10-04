<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateUserRequest $request, $id)
    {
        // Prepare the data
        $data = $request->only(['name', 'email']); // Include the fields you need

        if(!empty($request->password)) {
            $data['password'] = Hash::make($request->password); // Hash the password
        }

        $result = $this->repository->update($id, $data);

        return response()->json($result);
    }
}