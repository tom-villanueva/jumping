<?php

namespace Tests\Feature;

use App\Models\Articulo;
use App\Models\Inventario;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talle;
use App\Models\TipoArticulo;
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

    /** @test */
    public function test_user_can_delete_articulo_with_inventario()
    {
        $user = $this->createStubUser();

        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca =  Marca::factory()->create();
        $modelo =  Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $articulo = new Articulo([
            'descripcion' => 'sss',
            'codigo' => '001',
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
        ]);

        $articulo->saveQuietly();

        $inventario = Inventario::factory()->create([
            'articulo_id' => $articulo->id,
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'stock' => 1
        ]);

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->deleteJson("/api/articulos/{$articulo->id}");
        
        $response->assertStatus(200);
        
        $this->assertSoftDeleted('articulo', [
            'id' => $articulo->id,
            'codigo' => $articulo->codigo,
            'descripcion' => $articulo->descripcion
        ]);

        $this->assertSoftDeleted('inventario', [
            'id' => $inventario->id
        ]);
    }

    public function test_articulo_observer_updates_stock_on_delete()
    {
        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca =  Marca::factory()->create();
        $modelo =  Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $inventario = Inventario::factory()->create([
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'stock' => 0
        ]);

        $articulo = Articulo::factory()->create([
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
        ]);

        // cuando hace create ahora el stock es 1 xD

        // Delete the articulo
        $articulo->delete();

        // Check if the stock was decremented by 1
        $this->assertDatabaseHas('inventario', [
            'id' => $inventario->id,
            'stock' => 0
        ]);
    }
}