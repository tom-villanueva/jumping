<?php

namespace Tests\Unit;

use App\Models\Empleado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class EmpleadoTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_empleados_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Empleado(), 
            fillable: [
                'name',
                'email',
                'password',
                'isAdmin'
            ],
            casts: [
                'id' => 'int', 
                'password' => 'hashed'
                // 'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'empleados',
            hidden: [
                'password',
                'remember_token'
            ]
        );
    }

    /* Tests de relaciones */
}