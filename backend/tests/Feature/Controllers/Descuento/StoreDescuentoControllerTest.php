<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreDescuentoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_descuento()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'valor' => -1,
            'descripcion' => 'Algo',
            'tipo_descuento' => ''
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/descuentos', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['valor', 'tipo_descuento']);
    }

	public function test_unauthorized_user_cannot_store_descuento()
	{
		$response = $this->postJson('/api/descuentos', [
            'valor' => 50,
            'descripcion' => 'Descuento',
            'tipo_descuento' => true
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_descuento()
    {
        $user = $this->createStubUser();

        $data = [
            'valor' => 50,
            'descripcion' => 'Descuento',
            'tipo_descuento' => true
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/descuentos", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "valor" => $data['valor'],
            "descripcion" => $data['descripcion'],
            "tipo_descuento" => $data['tipo_descuento']
        ]);
        
        $this->assertDatabaseHas('descuentos', [
            "id" => $response['id'],
            "valor" => $data['valor'],
            "descripcion" => $data['descripcion'],
            "tipo_descuento" => $data['tipo_descuento']
        ]);
    }
}