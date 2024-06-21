<?php

namespace Tests\Feature;

use App\Models\Articulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class DeleteArticuloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_unauthorized_user_can_not_delete_articulo()
    {
        $articulo = Articulo::factory()->create();

        $response = $this->deleteJson("/api/articulos/{$articulo->id}");

        $response->assertStatus(401);
    }

    public function test_user_can_delete_articulo()
    {
        $user = $this->createStubUser();

        $articulo = Articulo::factory()->create();

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/articulos/{$articulo->id}");

        $response->assertStatus(200);
        
        $this->assertSoftDeleted('articulo', [
            'id' => $articulo->id,
            'codigo' => $articulo->codigo,
            'descripcion' => $articulo->descripcion
        ]);
    }
}