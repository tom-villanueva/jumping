<?php

namespace Tests\Feature;

use App\Models\TipoPersona;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateTipoPersonaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_tipo_persona_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $tipo_persona = TipoPersona::factory()->create();
        $tipo_persona2 = TipoPersona::factory()->create();

        $data = [
            // ejemplo unique descripcion
            'descripcion' => $tipo_persona->descripcion,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/tipo_personas/{$tipo_persona2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['descripcion']);
    }

    public function test_unauthorized_user_can_not_update_tipo_persona()
    {
        $tipo_persona = TipoPersona::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/tipo_personas/{$tipo_persona->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_tipo_persona()
    {
        $user = $this->createStubUser();

        $tipo_persona = TipoPersona::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/tipo_personas/{$tipo_persona->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            /* rellenar */
        ]);
        
        $this->assertDatabaseHas('tipo_personas', [
            "id" => $response['id'],
        ]);
    }
}