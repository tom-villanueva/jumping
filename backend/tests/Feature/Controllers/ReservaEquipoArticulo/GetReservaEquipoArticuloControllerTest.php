<?php

namespace Tests\Feature;

use App\Models\ReservaEquipoArticulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetReservaEquipoArticuloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_reserva_equipo_articulos()
    {
        ReservaEquipoArticulo::factory()->count(3)->create();

        $response = $this->getJson('api/reserva-equipo-articulos');

        $response->assertStatus(401);
    }

    public function test_user_can_get_reserva_equipo_articulos()
    {
        ReservaEquipoArticulo::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/reserva-equipo-articulos');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_reserva_equipo_articulo_by_id()
    {
        $reserva_equipo_articulo = ReservaEquipoArticulo::factory()->create();

        $response = $this->getJson("api/reserva-equipo-articulos/{$reserva_equipo_articulo->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_reserva_equipo_articulo_by_id()
    {
        $reserva_equipo_articulo = ReservaEquipoArticulo::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/reserva-equipo-articulos/{$reserva_equipo_articulo->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $reserva_equipo_articulo->id,
        ]);
    }
}