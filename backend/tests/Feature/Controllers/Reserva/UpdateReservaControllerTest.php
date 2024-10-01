<?php

namespace Tests\Feature;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateReservaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_reserva_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $reserva = Reserva::factory()->create();

        $data = [
            'comentario' => null,
            'user_id' => 25,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/reservas/{$reserva->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['user_id']);
    }

    public function test_unauthorized_user_can_not_update_reserva()
    {
        $reserva = Reserva::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/reservas/{$reserva->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_reserva()
    {
        $user = $this->createStubUser();

        $reserva = Reserva::factory()->create();

        $data = [
            'comentario' => "nuevo comment",
            'user_id' => $reserva->user_id,
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/reservas/{$reserva->id}", $data);
        
        $response->assertStatus(200);
        $response->assertJson([
            'comentario' => $data['comentario'],
            'user_id' => $data['user_id']
        ]);
        
        $this->assertDatabaseHas('reservas', [
            "id" => $response['id'],
        ]);
    }
}