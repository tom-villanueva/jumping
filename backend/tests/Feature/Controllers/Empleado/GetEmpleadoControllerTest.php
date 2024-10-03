<?php

namespace Tests\Feature;

use App\Models\Empleado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetEmpleadoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_empleados()
    {
        Empleado::factory()->count(3)->create();

        $response = $this->getJson('api/empleados');

        $response->assertStatus(401);
    }

    public function test_user_can_get_empleados()
    {
        Empleado::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/empleados');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_unauthorized_user_cannot_get_empleado_by_id()
    {
        $empleado = Empleado::factory()->create();

        $response = $this->getJson("api/empleados/{$empleado->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_empleado_by_id()
    {
        $empleado = Empleado::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/empleados/{$empleado->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $empleado->id,
        ]);
    }
}