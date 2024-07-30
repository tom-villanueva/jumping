<?php

namespace Tests\Feature;

use App\Models\ReservaEquipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetReservaEquipoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_reserva_equipos()
    {
        ReservaEquipo::factory()->count(3)->create();

        $response = $this->getJson('api/reserva-equipos');

        $response->assertStatus(401);
    }

    public function test_user_can_get_reserva_equipos()
    {
        ReservaEquipo::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/reserva-equipos');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_reserva_equipo_by_id()
    {
        $reserva_equipo = ReservaEquipo::factory()->create();

        $response = $this->getJson("api/reserva-equipos/{$reserva_equipo->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_reserva_equipo_by_id()
    {
        $reserva_equipo = ReservaEquipo::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/reserva-equipos/{$reserva_equipo->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $reserva_equipo->id,
        ]);
    }
}