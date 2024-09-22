<?php

namespace Tests\Feature;

use App\Models\Inventario;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talle;
use App\Models\TipoArticulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateInventarioControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_inventario_update()
    {
        // Arrange
		$user = $this->createStubUser();

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

        $data = [
            'talle_id' => 111,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/inventarios/{$inventario->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['talle_id']);
    }

    public function test_unauthorized_user_can_not_update_inventario()
    {
        $inventario = Inventario::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/inventarios/{$inventario->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_inventario()
    {
        $user = $this->createStubUser();

        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca =  Marca::factory()->create();
        $modelo =  Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $inventario = Inventario::factory()->create([
            "talle_id" => $talle->id,
            "tipo_articulo_id" => $tipo_articulo->id,
            "marca_id" => $marca->id,
            "modelo_id" => $modelo->id,
            "stock" => 0
        ]);

        $tipo_articulo2 = TipoArticulo::factory()->create();

        $data = [
            "talle_id" => $talle->id,
            "tipo_articulo_id" => $tipo_articulo2->id,
            "marca_id" => $marca->id,
            "modelo_id" => $modelo->id,
            "stock" => 10
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/inventarios/{$inventario->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            "talle_id" => $data["talle_id"],
            "tipo_articulo_id" => $data["tipo_articulo_id"],
            "marca_id" => $data["marca_id"],
            "modelo_id" => $data["modelo_id"],
            "stock" => $data["stock"]
        ]);
        
        $this->assertDatabaseHas('inventario', [
            "id" => $response['id'],
        ]);
    }
}