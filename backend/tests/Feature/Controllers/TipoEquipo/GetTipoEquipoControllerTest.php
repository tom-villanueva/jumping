<?php

namespace Tests\Feature;

use App\Models\TipoEquipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetTipoEquipoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_cannot_get_tipo_equipos()
    {
        TipoEquipo::factory()->count(3)->create();

        $response = $this->getJson('api/tipo-equipos');

        $response->assertStatus(401);
    }

    public function test_user_can_get_tipo_equipos()
    {
        TipoEquipo::factory()->count(3)->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson('api/tipo-equipos');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_unauthorized_user_cannot_get_tipo_equipo_by_id()
    {
        $tipo_equipo = TipoEquipo::factory()->create();

        $response = $this->getJson("api/tipo-equipos/{$tipo_equipo->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_get_tipo_equipo_by_id()
    {
        $tipo_equipo = TipoEquipo::factory()->create();
        $user = $this->createStubUser();

        $response = $this->actingAs($user, $user->getModelGuard())->getJson("api/tipo-equipos/{$tipo_equipo->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $tipo_equipo->id,
        ]);
    }
}