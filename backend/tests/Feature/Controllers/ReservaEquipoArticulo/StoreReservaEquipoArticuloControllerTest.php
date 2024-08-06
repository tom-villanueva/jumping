<?php

namespace Tests\Feature;

use App\Models\Articulo;
use App\Models\ReservaEquipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreReservaEquipoArticuloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_reserva_equipo_articulo()
    {
        // Arrange
		$user = $this->createStubUser();

        $data = [
            'reserva_equipo_id' => 120,
            'articulo_id' => 10,
            'devuelto' => false
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/reserva-equipo-articulos', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([ 'reserva_equipo_id', 'articulo_id' ]);
    }

	public function test_unauthorized_user_cannot_store_reserva_equipo_articulo()
	{
		$response = $this->postJson('/api/reserva-equipo-articulos', [
            
        ]);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_reserva_equipo_articulo()
    {
        $user = $this->createStubUser();

        $data = [
            'reserva_equipo_id' => ReservaEquipo::factory()->create()->id,
            'articulo_id' => Articulo::factory()->create()->id,
            'devuelto' => false
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/reserva-equipo-articulos", $data);

        $response->assertStatus(201);
        $response->assertJson([
            'reserva_equipo_id' => $data['reserva_equipo_id'],
            'articulo_id' => $data['articulo_id'],
            'devuelto' => false
        ]);
        
        $this->assertDatabaseHas('reserva_equipo_articulo', [
            "id" => $response['id'],
        ]);
    }
}