<?php

namespace Tests\Feature;

use App\Models\ReservaEquipoEquipoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetReservaEquipoEquipoPrecioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_reserva_equipo_equipo_precios()
    {
        ReservaEquipoEquipoPrecio::factory()->count(3)->create();

        $response = $this->getJson('api/reserva-equipo-equipo-precios');

        $response->assertStatus(401);
    }

    public function test_user_can_get_reserva_equipo_equipo_precios()
    {
        ReservaEquipoEquipoPrecio::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/reserva-equipo-equipo-precios');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_reserva_equipo_equipo_precio_by_id()
    {
        $reserva_equipo_equipo_precio = ReservaEquipoEquipoPrecio::factory()->create();

        $response = $this->getJson("api/reserva-equipo-equipo-precios/{$reserva_equipo_equipo_precio->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_reserva_equipo_equipo_precio_by_id()
    {
        $reserva_equipo_equipo_precio = ReservaEquipoEquipoPrecio::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/reserva-equipo-equipo-precios/{$reserva_equipo_equipo_precio->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $reserva_equipo_equipo_precio->id,
        ]);
    }
}