<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreTrasladoAsientoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_traslado_asiento()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            /* rellenar */
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/traslado_asientos', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ /* rellenar */ ]);
    }

	public function test_unauthorized_user_cannot_store_traslado_asiento()
	{
		$response = $this->postJson('/api/traslado_asientos', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_traslado_asiento()
    {
        $user = $this->createStubUser();

        $data = [
            /* rellenar */
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/traslado_asientos", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "id" => $data['id'],
        ]);
        
        $this->assertDatabaseHas('traslado_asientos', [
            "id" => $response['id'],
        ]);
    }
}