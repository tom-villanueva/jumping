<?php

namespace Tests\Feature;

use App\Models\Traslado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetTrasladoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_traslados()
    {
        Traslado::factory()->count(3)->create();

        $response = $this->getJson('api/traslados');

        $response->assertStatus(401);
    }

    public function test_user_can_get_traslados()
    {
        Traslado::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/traslados');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_traslado_by_id()
    {
        $traslado = Traslado::factory()->create();

        $response = $this->getJson("api/traslados/{$traslado->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_traslado_by_id()
    {
        $traslado = Traslado::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/traslados/{$traslado->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $traslado->id,
        ]);
    }
}