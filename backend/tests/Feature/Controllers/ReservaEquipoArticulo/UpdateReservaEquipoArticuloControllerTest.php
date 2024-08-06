<?php

namespace Tests\Feature;

use App\Models\Articulo;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoArticulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateReservaEquipoArticuloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_reserva_equipo_articulo_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $reserva_equipo_articulo = ReservaEquipoArticulo::factory()->create();

        $data = [
            'reserva_equipo_id' => 120,
            'articulo_id' => 10,
            'devuelto' => false
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/reserva-equipo-articulos/{$reserva_equipo_articulo->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['reserva_equipo_id', 'articulo_id']);
    }

    public function test_unauthorized_user_can_not_update_reserva_equipo_articulo()
    {
        $reserva_equipo_articulo = ReservaEquipoArticulo::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/reserva-equipo-articulos/{$reserva_equipo_articulo->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_reserva_equipo_articulo()
    {
        $user = $this->createStubUser();

        $reserva_equipo_articulo = ReservaEquipoArticulo::factory()->create();

        $nuevo_reserva_equipo = ReservaEquipo::factory()->create();
        $nuevo_articulo = Articulo::factory()->create();

        $data = [
            'reserva_equipo_id' => $nuevo_reserva_equipo->id,
            'articulo_id' => $nuevo_articulo->id,
            'devuelto' => true
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/reserva-equipo-articulos/{$reserva_equipo_articulo->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'reserva_equipo_id' => $data['reserva_equipo_id'],
            'articulo_id' => $data['articulo_id'],
            'devuelto' => $data['devuelto']
        ]);
        
        $this->assertDatabaseHas('reserva_equipo_articulo', [
            "id" => $response['id'],
        ]);
    }
}