<?php

namespace Tests\Feature;

use App\Models\Articulo;
use App\Models\TipoArticuloTalle;
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

    public function test_articulo_observer_updates_stock_on_delete()
    {
        $tipoArticuloTalle = TipoArticuloTalle::factory()->create(['stock' => 0]);

        $articulo = Articulo::factory()->create([
            'tipo_articulo_talle_id' => $tipoArticuloTalle->id,
        ]);

        // cuando hace create ahora el stock es 1 xD

        // Delete the articulo
        $articulo->delete();

        // Check if the stock was decremented by 1
        $this->assertDatabaseHas('tipo_articulo_talle', [
            'id' => $tipoArticuloTalle->id,
            'stock' => 0
        ]);
    }
}