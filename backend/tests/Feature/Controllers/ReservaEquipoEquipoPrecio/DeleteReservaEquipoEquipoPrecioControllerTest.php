<?php

namespace Tests\Feature;

use App\Models\ReservaEquipoEquipoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteReservaEquipoEquipoPrecioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_reserva_equipo_equipo_precio()
    {
        $reserva_equipo_equipo_precio = ReservaEquipoEquipoPrecio::factory()->create();

        $response = $this->deleteJson("/api/reserva-equipo-equipo-precios/{$reserva_equipo_equipo_precio->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_reserva_equipo_equipo_precio()
    {
        $user = $this->createStubUser();

        $reserva_equipo_equipo_precio = ReservaEquipoEquipoPrecio::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/reserva-equipo-equipo-precios/{$reserva_equipo_equipo_precio->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('reserva_equipo_equipo_precio', [
            'id' => $reserva_equipo_equipo_precio->id,
        ]);
    }
}