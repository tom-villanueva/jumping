<?php

namespace Tests\Feature;

use App\Models\Modelo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetModeloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_modelos()
    {
        Modelo::factory()->count(3)->create();

        $response = $this->getJson('api/modelos');

        $response->assertStatus(401);
    }

    public function test_user_can_get_modelos()
    {
        Modelo::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/modelos');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_modelo_by_id()
    {
        $modelo = Modelo::factory()->create();

        $response = $this->getJson("api/modelos/{$modelo->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_modelo_by_id()
    {
        $modelo = Modelo::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/modelos/{$modelo->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $modelo->id,
        ]);
    }
}