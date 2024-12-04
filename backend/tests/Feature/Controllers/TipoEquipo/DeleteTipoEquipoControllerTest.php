<?php

namespace Tests\Feature;

use App\Models\TipoEquipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteTipoEquipoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_tipo_equipo()
    {
        $tipo_equipo = TipoEquipo::factory()->create();

        $response = $this->deleteJson("/api/tipo-equipos/{$tipo_equipo->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_tipo_equipo()
    {
        $user = $this->createStubUser();

        $tipo_equipo = TipoEquipo::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/tipo-equipos/{$tipo_equipo->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('tipo_equipos', [
            'id' => $tipo_equipo->id,
        ]);
    }
}