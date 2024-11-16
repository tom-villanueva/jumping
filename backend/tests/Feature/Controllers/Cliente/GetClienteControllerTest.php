<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetClienteControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_clientes()
    {
        Cliente::factory()->count(3)->create();

        $response = $this->getJson('api/clientes');

        $response->assertStatus(401);
    }

    public function test_user_can_get_clientes()
    {
        Cliente::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/clientes');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_cliente_by_id()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->getJson("api/clientes/{$cliente->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_cliente_by_id()
    {
        $cliente = Cliente::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/clientes/{$cliente->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $cliente->id,
        ]);
    }
}