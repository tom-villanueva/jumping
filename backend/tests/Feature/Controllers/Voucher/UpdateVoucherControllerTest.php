<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateVoucherControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_voucher_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $voucher2 = Voucher::factory()->create();

        $data = [
            'descripcion' => '',
            'fecha_expiracion' => null,
            'dias' => null,
            'reserva_id' => 2455,
            'cliente_id' => 12
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/vouchers/{$voucher2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['fecha_expiracion', 'dias', 'reserva_id', 'cliente_id']);
    }

    public function test_unauthorized_user_can_not_update_voucher()
    {
        $voucher = Voucher::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/vouchers/{$voucher->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_voucher()
    {
        $user = $this->createStubUser();

        $voucher = Voucher::factory()->create();

        $data = [
            'descripcion' => 'hola',
            'fecha_expiracion' => Carbon::parse($voucher->fecha_expiracion)->addDay(1)->format('Y-m-d'),
            'dias' => 4,
            'reserva_id' => $voucher->reserva_id,
            'cliente_id' => $voucher->cliente_id
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/vouchers/{$voucher->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'descripcion' => $data['descripcion'],
            'fecha_expiracion' => $data['fecha_expiracion'],
            'dias' => $data['dias'],
            'reserva_id' => $data['reserva_id'],
            'cliente_id' => $data['cliente_id'],
        ]);
        
        $this->assertDatabaseHas('vouchers', [
            "id" => $response['id'],
        ]);
    }
}