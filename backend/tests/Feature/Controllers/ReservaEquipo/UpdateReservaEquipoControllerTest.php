<?php

namespace Tests\Feature;

use App\Models\ReservaEquipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateReservaEquipoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_reserva_equipo_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $reserva_equipo = ReservaEquipo::factory()->create();

        $data = [
            'reserva_id' => 10,
            'equipo_id' => 10
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/reserva-equipos/{$reserva_equipo->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['reserva_id', 'equipo_id']);
    }

    public function test_unauthorized_user_can_not_update_reserva_equipo()
    {
        $reserva_equipo = ReservaEquipo::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/reserva-equipos/{$reserva_equipo->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_reserva_equipo()
    {
        $user = $this->createStubUser();

        $reserva_equipo = ReservaEquipo::factory()->create();

        $data = [
            'altura' => $reserva_equipo->altura,
            'peso' => $reserva_equipo->peso,
            'num_calzado' => $reserva_equipo->num_calzado,
            'nombre' => "Nuevo nombre",
            'apellido' => "Nuevo apellido",
            'reserva_id' => $reserva_equipo->reserva_id,
            'equipo_id' => $reserva_equipo->equipo_id
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/reserva-equipos/{$reserva_equipo->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido']
        ]);
        
        $this->assertDatabaseHas('reserva_equipo', [
            "id" => $response['id'],
        ]);
    }
}