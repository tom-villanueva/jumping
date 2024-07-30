<?php

namespace Tests\Feature;

use App\Models\Equipo;
use App\Models\Reserva;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreReservaEquipoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_reserva_equipo()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'altura' => 'perro',
            'reserva_id' => 10,
            'equipo_id' => 10
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/reserva-equipos', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'reserva_id', 'equipo_id', 'altura' ]);
    }

	public function test_unauthorized_user_cannot_store_reserva_equipo()
	{
		$response = $this->postJson('/api/reserva-equipos', [
            /* rellenar */
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_reserva_equipo()
    {
        $user = $this->createStubUser();

        $data = [
            'altura' => 178,
            'peso' => 86,
            'num_calzado' => 42,
            'nombre' => "Tom",
            'apellido' => "Villanueva",
            'reserva_id' => Reserva::factory()->create()->id,
            'equipo_id' => Equipo::factory()->create()->id
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/reserva-equipos", $data);
        
        $response->assertStatus(201);
        $response->assertJson([
            "reserva_id" => $data['reserva_id'],
            "equipo_id" => $data['equipo_id'],
            "altura" => $data['altura'],
            "peso" => $data['peso'],
            "num_calzado" => $data['num_calzado'],
            "nombre" => $data['nombre'],
            "apellido" => $data['apellido'],
        ]);
        
        $this->assertDatabaseHas('reserva_equipo', [
            "id" => $response['id'],
        ]);
    }
}