<?php

namespace Tests\Feature;

use App\Models\TipoPersona;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetTipoPersonaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_tipo_personas()
    {
        TipoPersona::factory()->count(3)->create();

        $response = $this->getJson('api/tipo_personas');

        $response->assertStatus(401);
    }

    public function test_user_can_get_tipo_personas()
    {
        TipoPersona::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/tipo_personas');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_tipo_persona_by_id()
    {
        $tipo_persona = TipoPersona::factory()->create();

        $response = $this->getJson("api/tipo_personas/{$tipo_persona->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_tipo_persona_by_id()
    {
        $tipo_persona = TipoPersona::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/tipo_personas/{$tipo_persona->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $tipo_persona->id,
        ]);
    }
}