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

        $today = Carbon::now()->format('Y-m-d');
        $todaySubOneDay = Carbon::now()->subDay()->format('Y-m-d');

        $data = [
            'fecha_desde' => $today,
            'fecha_hasta' => $todaySubOneDay,
            'comentario' => null,
            'estado_id' => 10,
            'user_id' => null,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/reservas/{$reserva->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['fecha_hasta', 'estado_id']);
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
            'fecha_prueba' => $reserva->fecha_prueba,
            'fecha_desde' => $reserva->fecha_desde,
            'fecha_hasta' => $reserva->fecha_hasta,
            'comentario' => "nuevo comment",
            'estado_id' => $reserva->estado_id,
            'user_id' => $reserva->user_id,
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/reservas/{$reserva->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'fecha_prueba' => $data['fecha_prueba'],
            'fecha_desde' => $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'comentario' => $data['comentario'],
            'estado_id' => $data['estado_id'],
            'user_id' => $data['user_id']
        ]);
        
        $this->assertDatabaseHas('reservas', [
            "id" => $response['id'],
        ]);
    }
}