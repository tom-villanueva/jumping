<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreMarcaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_marca()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'descripcion' => ''
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/marcas', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'descripcion' ]);
    }

	public function test_unauthorized_user_cannot_store_marca()
	{
		$response = $this->postJson('/api/marcas', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_marca()
    {
        $user = $this->createStubUser();

        $data = [
            'descripcion' => 'Marca test'
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/marcas", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "descripcion" => $data['descripcion'],
        ]);
        
        $this->assertDatabaseHas('marca', [
            "id" => $response['id'],
        ]);
    }
}