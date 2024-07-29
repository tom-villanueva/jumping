<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreEstadoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_estado()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'descripcion' => null
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/estados', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'descripcion' ]);
    }

	public function test_unauthorized_user_cannot_store_estado()
	{
		$response = $this->postJson('/api/estados', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_estado()
    {
        $user = $this->createStubUser();

        $data = [
            'descripcion' => 'prueba'
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/estados", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "descripcion" => $data['descripcion']
        ]);
        
        $this->assertDatabaseHas('estados', [
            "id" => $response['id'],
        ]);
    }
}