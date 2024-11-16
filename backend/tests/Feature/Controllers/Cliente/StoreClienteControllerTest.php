<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreClienteControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_cliente()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/clientes', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'nombre', 'apellido', 'email' ]);
    }

	public function test_unauthorized_user_cannot_store_cliente()
	{
		$response = $this->postJson('/api/clientes', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_cliente()
    {
        $user = $this->createStubUser();

        $data = [
            'nombre' => 'tomas',
            'apellido' => 'villanueva',
            'email' => 'tomas@gmail.com',
            'telefono' => '29011111',
            'tipo_persona_id' => null,
            'user_id' => null,
            'fecha_nacimiento' => '',
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/clientes", $data);

        $response->assertStatus(201);
        $response->assertJson([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'tipo_persona_id' => $data['tipo_persona_id'],
            'user_id' => $data['user_id'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
        ]);
        
        $this->assertDatabaseHas('clientes', [
            "id" => $response['id'],
        ]);
    }
}