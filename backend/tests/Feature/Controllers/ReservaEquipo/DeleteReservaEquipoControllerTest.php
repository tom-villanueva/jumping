<?php

namespace Tests\Feature;

use App\Models\Articulo;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoArticulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteReservaEquipoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_reserva_equipo()
    {
        $reserva_equipo = ReservaEquipo::factory()->create();

        $response = $this->deleteJson("/api/reserva-equipos/{$reserva_equipo->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_reserva_equipo()
    {
        $user = $this->createStubUser();

        $articulo = Articulo::factory()->create();

        $reserva_equipo = ReservaEquipo::factory()->create();

        ReservaEquipoArticulo::factory()->create([
            'reserva_equipo_id' => $reserva_equipo->id,
            'articulo_id' => $articulo->id,
            'devuelto' => false
        ]);

        ReservaEquipoArticulo::factory()->create([
            'reserva_equipo_id' => $reserva_equipo->id,
            'articulo_id' => $articulo->id,
            'devuelto' => false
        ]);

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/reserva-equipos/{$reserva_equipo->id}");

        $response->assertStatus(200);
        
        $this->assertDatabaseMissing('reserva_equipo', [
            'id' => $reserva_equipo->id,
        ]);

        $this->assertDatabaseHas('articulo', [
            'id' => $articulo->id,
            'disponible' => true
        ]);
    }
}