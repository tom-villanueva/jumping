<?php

namespace Tests\Feature;

use App\Models\Estado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetEstadoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_estados()
    {
        Estado::factory()->count(3)->create();

        $response = $this->getJson('api/estados');

        $response->assertStatus(401);
    }

    public function test_user_can_get_estados()
    {
        Estado::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/estados');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_estado_by_id()
    {
        $estado = Estado::factory()->create();

        $response = $this->getJson("api/estados/{$estado->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_estado_by_id()
    {
        $estado = Estado::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/estados/{$estado->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $estado->id,
        ]);
    }
}