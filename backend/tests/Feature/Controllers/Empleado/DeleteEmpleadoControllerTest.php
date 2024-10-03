<?php

namespace Tests\Feature;

use App\Models\Empleado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteEmpleadoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_empleado()
    {
        $empleado = Empleado::factory()->create();

        $response = $this->deleteJson("/api/empleados/{$empleado->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_empleado()
    {
        $user = $this->createStubUser();

        $empleado = Empleado::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/empleados/{$empleado->id}");

        $response->assertStatus(200);
        
        $this->assertDatabaseMissing('empleados', [
            'id' => $empleado->id,
        ]);
    }
}