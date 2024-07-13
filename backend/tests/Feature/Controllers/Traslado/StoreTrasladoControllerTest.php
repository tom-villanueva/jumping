<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreTrasladoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_traslado()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            /* rellenar */
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/traslados', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ /* rellenar */ ]);
    }

	public function test_unauthorized_user_cannot_store_traslado()
	{
		$response = $this->postJson('/api/traslados', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_traslado()
    {
        $user = $this->createStubUser();

        $data = [
            /* rellenar */
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/traslados", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "id" => $data['id'],
        ]);
        
        $this->assertDatabaseHas('traslados', [
            "id" => $response['id'],
        ]);
    }
}