<?php

namespace Tests\Feature;

use App\Models\TrasladoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteTrasladoPrecioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_traslado_precio()
    {
        $traslado_precio = TrasladoPrecio::factory()->create();

        $response = $this->deleteJson("/api/traslado_precios/{$traslado_precio->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_traslado_precio()
    {
        $user = $this->createStubUser();

        $traslado_precio = TrasladoPrecio::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/traslado_precios/{$traslado_precio->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('traslado_precios', [
            'id' => $traslado_precio->id,
        ]);
    }
}