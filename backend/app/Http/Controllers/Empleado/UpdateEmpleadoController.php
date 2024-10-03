<?php
namespace App\Http\Controllers\Empleado;

use App\Http\Controllers\Controller;
use App\Repositories\Empleado\EmpleadoRepository;
use App\Http\Requests\Empleado\UpdateEmpleadoRequest;
use Illuminate\Support\Facades\Hash;

class UpdateEmpleadoController extends Controller
{
    private $repository;

    public function __construct(EmpleadoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateEmpleadoRequest $request, $id)
    {
        // Prepare the data, ensuring the password is hashed
        $data = $request->only(['name', 'email', 'isAdmin']); // Include the fields you need

        if(!empty($request->password)) {
            $data['password'] = Hash::make($request->password); // Hash the password
        }

        $result = $this->repository->update($id, $data);

        return response()->json($result);
    }
}
