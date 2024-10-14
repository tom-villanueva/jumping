<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreTrasladoPrecioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_traslado_precio()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            /* rellenar */
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/traslado_precios', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ /* rellenar */ ]);
    }

	public function test_unauthorized_user_cannot_store_traslado_precio()
	{
		$response = $this->postJson('/api/traslado_precios', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_traslado_precio()
    {
        $user = $this->createStubUser();

        $data = [
            /* rellenar */
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/traslado_precios", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "id" => $data['id'],
        ]);
        
        $this->assertDatabaseHas('traslado_precios', [
            "id" => $response['id'],
        ]);
    }
}