<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreTipoPersonaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_tipo_persona()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            /* rellenar */
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/tipo_personas', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ /* rellenar */ ]);
    }

	public function test_unauthorized_user_cannot_store_tipo_persona()
	{
		$response = $this->postJson('/api/tipo_personas', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_tipo_persona()
    {
        $user = $this->createStubUser();

        $data = [
            /* rellenar */
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/tipo_personas", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "id" => $data['id'],
        ]);
        
        $this->assertDatabaseHas('tipo_personas', [
            "id" => $response['id'],
        ]);
    }
}