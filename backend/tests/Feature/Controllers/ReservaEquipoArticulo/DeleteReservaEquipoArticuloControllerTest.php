<?php

namespace Tests\Feature;

use App\Models\ReservaEquipoArticulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteReservaEquipoArticuloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_reserva_equipo_articulo()
    {
        $reserva_equipo_articulo = ReservaEquipoArticulo::factory()->create();

        $response = $this->deleteJson("/api/reserva-equipo-articulos/{$reserva_equipo_articulo->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_reserva_equipo_articulo()
    {
        $user = $this->createStubUser();

        $reserva_equipo_articulo = ReservaEquipoArticulo::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/reserva-equipo-articulos/{$reserva_equipo_articulo->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('reserva_equipo_articulo', [
            'id' => $reserva_equipo_articulo->id,
        ]);
    }
}