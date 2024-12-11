<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetMisReservasControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    /** @test */
    public function test_cliente_can_get_their_reservas()
    {
        $user = User::factory()->create();

        $cliente = Cliente::factory()->create([
            'user_id' => $user->id
        ]);

        $reservas = Reserva::factory()->count(2)->create([
            'cliente_id' => $cliente->id
        ]);

        $response = $this->actingAs($user)->getJson(
            "/api/clientes/mis-reservas"
        );

        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }
}