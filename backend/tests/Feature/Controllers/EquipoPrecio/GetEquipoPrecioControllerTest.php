<?php

namespace Tests\Feature;

use App\Models\EquipoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetEquipoPrecioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_equipo_precios()
    {
        EquipoPrecio::factory()->count(3)->create();

        $response = $this->getJson('api/equipo-precios');

        $response->assertStatus(401);
    }

    public function test_user_can_get_equipo_precios()
    {
        EquipoPrecio::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/equipo-precios');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_equipo_precio_by_id()
    {
        $equipo_precio = EquipoPrecio::factory()->create();

        $response = $this->getJson("api/equipo-precios/{$equipo_precio->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_equipo_precio_by_id()
    {
        $equipo_precio = EquipoPrecio::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/equipo-precios/{$equipo_precio->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $equipo_precio->id,
        ]);
    }
}