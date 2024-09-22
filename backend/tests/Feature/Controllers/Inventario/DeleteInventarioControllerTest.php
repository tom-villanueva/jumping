<?php

namespace Tests\Feature;

use App\Models\Inventario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteInventarioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_inventario()
    {
        $inventario = Inventario::factory()->create();

        $response = $this->deleteJson("/api/inventarios/{$inventario->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_inventario()
    {
        $user = $this->createStubUser();

        $inventario = Inventario::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/inventarios/{$inventario->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('inventario', [
            'id' => $inventario->id,
        ]);
    }
}