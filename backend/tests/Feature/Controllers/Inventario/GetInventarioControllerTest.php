<?php

namespace Tests\Feature;

use App\Models\Inventario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetInventarioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_inventarios()
    {
        Inventario::factory()->count(3)->create();

        $response = $this->getJson('api/inventarios');

        $response->assertStatus(401);
    }

    public function test_user_can_get_inventarios()
    {
        Inventario::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/inventarios');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_inventario_by_id()
    {
        $inventario = Inventario::factory()->create();

        $response = $this->getJson("api/inventarios/{$inventario->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_inventario_by_id()
    {
        $inventario = Inventario::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/inventarios/{$inventario->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $inventario->id,
        ]);
    }
}