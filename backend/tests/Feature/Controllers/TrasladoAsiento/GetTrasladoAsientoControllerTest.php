<?php

namespace Tests\Feature;

use App\Models\TrasladoAsiento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetTrasladoAsientoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_traslado_asientos()
    {
        TrasladoAsiento::factory()->count(3)->create();

        $response = $this->getJson('api/traslado_asientos');

        $response->assertStatus(401);
    }

    public function test_user_can_get_traslado_asientos()
    {
        TrasladoAsiento::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/traslado_asientos');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_traslado_asiento_by_id()
    {
        $traslado_asiento = TrasladoAsiento::factory()->create();

        $response = $this->getJson("api/traslado_asientos/{$traslado_asiento->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_traslado_asiento_by_id()
    {
        $traslado_asiento = TrasladoAsiento::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/traslado_asientos/{$traslado_asiento->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $traslado_asiento->id,
        ]);
    }
}