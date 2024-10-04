<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StoreUserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreUserRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->only(['name', 'email']); // Include the fields you need
            $data['password'] = Hash::make($request->password); // Hash the password

            // Create the new user record
            $new_entity = $this->repository->create($data);

            $new_entity->email_verified_at = Carbon::now();
            $new_entity->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json($new_entity, 201);
    }
}