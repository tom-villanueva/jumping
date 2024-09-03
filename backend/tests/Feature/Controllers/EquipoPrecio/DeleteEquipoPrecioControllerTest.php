<?php

namespace Tests\Feature;

use App\Models\Equipo;
use App\Models\EquipoPrecio;
use App\Models\Reserva;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteEquipoPrecioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_equipo_precio()
    {
        $equipo_precio = EquipoPrecio::factory()->create();

        $response = $this->deleteJson("/api/equipo-precios/{$equipo_precio->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_equipo_precio()
    {
        $user = $this->createStubUser();

        $equipo_precio = EquipoPrecio::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/equipo-precios/{$equipo_precio->id}");

        $response->assertStatus(200);
        
        $this->assertDatabaseMissing('equipo_precio', [
            'id' => $equipo_precio->id,
        ]);
    }

    public function test_user_cannot_delete_equipo_precio_with_reservas()
    {
        $user = $this->createStubUser();

        // Arrange
        $equipo = Equipo::factory()->create();
        $equipo_precio = EquipoPrecio::factory()->create([
            "equipo_id" => $equipo->id
        ]);

        $reserva = Reserva::factory()->create([]);
        $reserva_equipo = ReservaEquipo::factory()->create([
            "equipo_id" => $equipo->id,
            "reserva_id" => $reserva->id
        ]);

        $reserva_equipo_precio = ReservaEquipoPrecio::factory()->create([
            'reserva_equipo_id' => $reserva_equipo->id,
            'equipo_precio_id' => $equipo_precio->id,
        ]);

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/equipo-precios/{$equipo_precio->id}");

        $response->assertUnprocessable();
        $response->assertInvalid([
            'reserva_equipo_precio_id' => 'El precio ya tiene reservas asociadas tiene reservas asociadas.'
        ]);
    }
}