<?php

namespace Tests\Feature;

use App\Models\Reserva;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetReservaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_reservas()
    {
        Reserva::factory()->count(3)->create();

        $response = $this->getJson('api/reservas');

        $response->assertStatus(401);
    }

    public function test_user_can_get_reservas()
    {
        Reserva::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/reservas');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_reserva_by_id()
    {
        $reserva = Reserva::factory()->create();

        $response = $this->getJson("api/reservas/{$reserva->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_reserva_by_id()
    {
        $reserva = Reserva::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/reservas/{$reserva->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $reserva->id,
        ]);
    }
}