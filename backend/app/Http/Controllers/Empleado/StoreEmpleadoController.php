<?php
namespace App\Http\Controllers\Empleado;

use App\Http\Controllers\Controller;
use App\Repositories\Empleado\EmpleadoRepository;
use App\Http\Requests\Empleado\StoreEmpleadoRequest;
use Illuminate\Support\Facades\Hash;

class StoreEmpleadoController extends Controller
{
    private $repository;

    public function __construct(EmpleadoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StoreEmpleadoRequest $request)
    {
        // Prepare the data, ensuring the password is hashed
        $data = $request->only(['name', 'email', 'isAdmin']); // Include the fields you need
        $data['password'] = Hash::make($request->password); // Hash the password

        // Create the new employee record
        $new_entity = $this->repository->create($data);

        return response()->json($new_entity, 201);
    }
}