<?php

namespace Tests\Feature;

use App\Models\TipoPersona;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteTipoPersonaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_tipo_persona()
    {
        $tipo_persona = TipoPersona::factory()->create();

        $response = $this->deleteJson("/api/tipo_personas/{$tipo_persona->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_tipo_persona()
    {
        $user = $this->createStubUser();

        $tipo_persona = TipoPersona::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/tipo_personas/{$tipo_persona->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('tipo_personas', [
            'id' => $tipo_persona->id,
        ]);
    }
}