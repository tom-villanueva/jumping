<?php

namespace Tests\Feature;

use App\Models\Modelo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteModeloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_modelo()
    {
        $modelo = Modelo::factory()->create();

        $response = $this->deleteJson("/api/modelos/{$modelo->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_modelo()
    {
        $user = $this->createStubUser();

        $modelo = Modelo::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/modelos/{$modelo->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('modelo', [
            'id' => $modelo->id,
        ]);
    }
}