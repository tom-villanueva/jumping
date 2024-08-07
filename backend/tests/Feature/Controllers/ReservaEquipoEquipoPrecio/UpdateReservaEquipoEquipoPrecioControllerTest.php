<?php

namespace Tests\Feature;

use App\Models\EquipoDescuento;
use App\Models\EquipoPrecio;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoEquipoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateReservaEquipoEquipoPrecioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_reserva_equipo_equipo_precio_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $reserva_equipo_equipo_precio = ReservaEquipoEquipoPrecio::factory()->create();

        $data = [
            'reserva_equipo_id' => null,
            'equipo_precio_id' => null,
            'equipo_descuento_id' => 10
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/reserva-equipo-equipo-precios/{$reserva_equipo_equipo_precio->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['reserva_equipo_id', 'equipo_precio_id', 'equipo_descuento_id']);
    }

    public function test_unauthorized_user_can_not_update_reserva_equipo_equipo_precio()
    {
        $reserva_equipo_equipo_precio = ReservaEquipoEquipoPrecio::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/reserva-equipo-equipo-precios/{$reserva_equipo_equipo_precio->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_reserva_equipo_equipo_precio()
    {
        $user = $this->createStubUser();

        $reserva_equipo_equipo_precio = ReservaEquipoEquipoPrecio::factory()->create();

        $data = [
            'reserva_equipo_id' => ReservaEquipo::factory()->create()->id,
            'equipo_precio_id' => EquipoPrecio::factory()->create()->id,
            'equipo_descuento_id' => EquipoDescuento::factory()->create()->id
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/reserva-equipo-equipo-precios/{$reserva_equipo_equipo_precio->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'reserva_equipo_id' => $data['reserva_equipo_id'], 
            'equipo_precio_id' => $data['equipo_precio_id'],
            'equipo_descuento_id' => $data['equipo_descuento_id']
        ]);
        
        $this->assertDatabaseHas('reserva_equipo_equipo_precio', [
            "id" => $response['id'],
        ]);
    }
}