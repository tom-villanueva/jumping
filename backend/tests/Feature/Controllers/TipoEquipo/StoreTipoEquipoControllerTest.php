<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreTipoEquipoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_tipo_equipo()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'descripcion' => null
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/tipo-equipos', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'descripcion' ]);
    }

	public function test_unauthorized_user_cannot_store_tipo_equipo()
	{
		$response = $this->postJson('/api/tipo-equipos', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_tipo_equipo()
    {
        $user = $this->createStubUser();

        $data = [
            'descripcion' => 'prueba'
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/tipo-equipos", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "descripcion" => $data['descripcion'],
        ]);
        
        $this->assertDatabaseHas('tipo_equipos', [
            "id" => $response['id'],
        ]);
    }
}