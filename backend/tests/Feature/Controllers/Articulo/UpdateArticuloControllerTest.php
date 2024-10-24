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

class UpdateArticuloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_articulo_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca =  Marca::factory()->create();
        $modelo =  Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $articulo = Articulo::factory()->create([
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
        ]);
        $articulo2 = Articulo::factory()->create([
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
        ]);

        $data = [
            'descripcion' => $articulo->descripcion,
            'codigo' => $articulo->codigo,
            'observacion' => '',
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'nro_serie' => $articulo->nro_serie
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/articulos/{$articulo2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['codigo', 'descripcion', 'nro_serie']);
    }

    public function test_unauthorized_user_can_not_update_articulo()
    {
        $articulo = Articulo::factory()->create();

        $data = [];

        $response = $this->putJson("/api/articulos/{$articulo->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_articulo()
    {
        $user = $this->createStubUser();

        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca =  Marca::factory()->create();
        $modelo =  Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $tipo_articulo2 = TipoArticulo::factory()->create();

        $articulo = Articulo::factory()->create([
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
        ]);

        $data = [
            'descripcion' => 'Probando cambio',
            'codigo' => $articulo->codigo,
            'observacion' => $articulo->observacion,
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo2->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'nro_serie' => 123,
            'disponible' => true
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/articulos/{$articulo->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "observacion" => null,
            "talle_id" => $talle->id,
            "tipo_articulo_id" => $tipo_articulo2->id,
            "marca_id" => $marca->id,
            "modelo_id" => $modelo->id,
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
        ]);
        
        $this->assertDatabaseHas('articulo', [
            "id" => $response['id'],
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "talle_id" => $talle->id,
            "tipo_articulo_id" => $tipo_articulo2->id,
            "marca_id" => $marca->id,
            "modelo_id" => $modelo->id,
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
        ]);
    }

    public function test_articulo_observer_updates_stock_on_disponible_change()
    {
        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca =  Marca::factory()->create();
        $modelo =  Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $tipo_articulo2 = TipoArticulo::factory()->create();

        $inventario = Inventario::factory()->create([
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'stock' => 9
        ]);

        $inventario2 = Inventario::factory()->create([
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo2->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'stock' => 10
        ]);
        
        $articulo = Articulo::factory()->create([
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
        ]);

        // Al crearse nuevo articulo inventario tiene stock 10 ahora

        // Ahora pertenece a inventario2
        $articulo->tipo_articulo_id = $tipo_articulo2->id;
        $articulo->save();

        // Check that the stock was decremented by 1
        $this->assertDatabaseHas('inventario', [
            'id' => $inventario->id,
            'stock' => 9,
        ]);

        // Check that the stock was incremented by 1
        $this->assertDatabaseHas('inventario', [
            'id' => $inventario2->id,
            'stock' => 11,
        ]);
    }

    public function test_articulo_observer_updates_stock_on_update()
    {
        $user = $this->createStubUser();

        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca =  Marca::factory()->create();
        $modelo =  Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $modelo2 = Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $articulo = Articulo::factory()->create([
            'descripcion' => 'primera desc',
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
        ]);

        // acá el inventario se crea con stock 1

        $data = [
            'descripcion' => 'Probando cambio',
            'codigo' => $articulo->codigo,
            'observacion' => $articulo->observacion,
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo2->id,
            'nro_serie' => 123,
            'disponible' => true
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/articulos/{$articulo->id}", $data);

        $this->assertDatabaseHas('inventario', [
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo2->id,
            'stock' => 1
        ]);

        $this->assertDatabaseHas('inventario', [
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'stock' => 0
        ]);
    }

    /** @test */
    public function test_user_can_update_articulo_with_inventario()
    {
        $user = $this->createStubUser();

        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca =  Marca::factory()->create();
        $modelo =  Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $tipo_articulo2 = TipoArticulo::factory()->create();

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
            'stock' => 10
        ]);

        $data = [
            'descripcion' => 'Probando cambio',
            'codigo' => $articulo->codigo,
            'observacion' => $articulo->observacion,
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo2->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'nro_serie' => 123,
            'disponible' => true
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/articulos/{$articulo->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "observacion" => null,
            "talle_id" => $talle->id,
            "tipo_articulo_id" => $tipo_articulo2->id,
            "marca_id" => $marca->id,
            "modelo_id" => $modelo->id,
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
        ]);
        
        $this->assertDatabaseHas('articulo', [
            "id" => $response['id'],
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "talle_id" => $talle->id,
            "tipo_articulo_id" => $tipo_articulo2->id,
            "marca_id" => $marca->id,
            "modelo_id" => $modelo->id,
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
        ]);

        $this->assertSoftDeleted('inventario', [
            'id' => $inventario->id
        ]);

        $this->assertDatabaseHas('inventario', [
            'articulo_id' => $articulo->id,
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'stock' => 10
        ]);
    }
}