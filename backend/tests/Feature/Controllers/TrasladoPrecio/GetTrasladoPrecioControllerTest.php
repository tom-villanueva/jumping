<?php

namespace Tests\Feature;

use App\Models\TrasladoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetTrasladoPrecioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_traslado_precios()
    {
        TrasladoPrecio::factory()->count(3)->create();

        $response = $this->getJson('api/traslado_precios');

        $response->assertStatus(401);
    }

    public function test_user_can_get_traslado_precios()
    {
        TrasladoPrecio::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/traslado_precios');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_traslado_precio_by_id()
    {
        $traslado_precio = TrasladoPrecio::factory()->create();

        $response = $this->getJson("api/traslado_precios/{$traslado_precio->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_traslado_precio_by_id()
    {
        $traslado_precio = TrasladoPrecio::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/traslado_precios/{$traslado_precio->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $traslado_precio->id,
        ]);
    }
}