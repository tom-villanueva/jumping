<?php

namespace Tests\Feature;

use App\Models\Estado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteEstadoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_estado()
    {
        $estado = Estado::factory()->create();

        $response = $this->deleteJson("/api/estados/{$estado->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_estado()
    {
        $user = $this->createStubUser();

        $estado = Estado::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/estados/{$estado->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('estados', [
            'id' => $estado->id,
        ]);
    }
}