<?php

namespace Tests\Feature;

use App\Models\Pago;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdatePagoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_pago_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $pago = Pago::factory()->create();

        $data = [
            'total' => '',
            'status' => '',
            'numero_comprobante' => '',
            'metodo_pago_id' => 25,
            'moneda_id' => 25
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/pagos/{$pago->id}", $data);

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

    public function test_unauthorized_user_can_not_update_pago()
    {
        $pago = Pago::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/pagos/{$pago->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_pago()
    {
        $user = $this->createStubUser();

        $pago = Pago::factory()->create();

        $data = [
            'total' => 100,
            'status' => 'failed',
            'numero_comprobante' => '1234',
            'metodo_pago_id' => 2,
            'moneda_id' => 2
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/pagos/{$pago->id}", $data);

        $response->assertStatus(200);
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