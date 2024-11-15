<?php

namespace Tests\Feature;

use App\Models\TrasladoAsiento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteTrasladoAsientoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_traslado_asiento()
    {
        $traslado_asiento = TrasladoAsiento::factory()->create();

        $response = $this->deleteJson("/api/traslado_asientos/{$traslado_asiento->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_traslado_asiento()
    {
        $user = $this->createStubUser();

        $traslado_asiento = TrasladoAsiento::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/traslado_asientos/{$traslado_asiento->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('traslado_asientos', [
            'id' => $traslado_asiento->id,
        ]);
    }
}