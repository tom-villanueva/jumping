<?php

namespace Tests;

use App\Models\Empleado;

trait WithStubUserEmpleado
{
    /**
     * @var \App\Models\Empleado
     */
    protected $user;

    /**
     * @return \App\Models\Empleado
     */
    public function createStubUser(array $data = [])
    {
        $data = array_merge([
            'name' => 'Test User',
            'email' => 'test-user-'.uniqid().'@example.com',
            'password' => bcrypt('123456'),
        ], $data);

        return $this->user = Empleado::create($data);
    }

    public function deleteStubUser()
    {
        $this->user->forceDelete();
    }
}