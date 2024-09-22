<?php

namespace Tests\Feature;

use App\Models\Marca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteMarcaControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_marca()
    {
        $marca = Marca::factory()->create();

        $response = $this->deleteJson("/api/marcas/{$marca->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_marca()
    {
        $user = $this->createStubUser();

        $marca = Marca::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/marcas/{$marca->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('marca', [
            'id' => $marca->id,
        ]);
    }
}