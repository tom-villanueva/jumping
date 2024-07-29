<?php

namespace Tests\Feature;

use App\Models\Traslado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteTrasladoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_traslado()
    {
        $traslado = Traslado::factory()->create();

        $response = $this->deleteJson("/api/traslados/{$traslado->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_traslado()
    {
        $user = $this->createStubUser();

        $traslado = Traslado::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/traslados/{$traslado->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('traslados', [
            'id' => $traslado->id,
        ]);
    }
}