<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StorePagoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_pago()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'total' => '',
            'status' => '',
            'numero_comprobante' => '',
            'metodo_pago_id' => 25,
            'moneda_id' => 25
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/pagos', $data);

        // dd($response);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'total',
            'status',
            'numero_comprobante',
            'metodo_pago_id',
            'moneda_id' 
        ]);
    }

	public function test_unauthorized_user_cannot_store_pago()
	{
		$response = $this->postJson('/api/pagos', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_pago()
    {
        $user = $this->createStubUser();

        $data = [
            'total' => 100,
            'status' => 'success',
            'numero_comprobante' => '123',
            'metodo_pago_id' => 1,
            'moneda_id' => 1
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/pagos", $data);

        $response->assertStatus(201);
        $response->assertJson([
            'total' => $data["total"],
            'status' => $data["status"],
            'numero_comprobante' => $data["numero_comprobante"],
            'metodo_pago_id' => $data["metodo_pago_id"],
            'moneda_id' => $data["moneda_id"]
        ]);
        
        $this->assertDatabaseHas('pagos', [
            "id" => $response['id'],
        ]);
    }
}