<?php

namespace Tests\Feature;

use App\Models\Articulo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talle;
use App\Models\TipoArticulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreArticuloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

	public function test_validation_fails_articulo()
    {
        // Arrange
		$user = $this->createStubUser();

        $articulo = Articulo::factory()->create();

        $data = [
            'codigo' => '', // Invalid data (codigo is required)
            'descripcion' => '',
			'observacion' => '',
            'tipo_articulo_id' => null,
            'talle_id' => null,
			'marca_id' => null,
            'modelo_id' => null,
            'nro_serie' => $articulo->nro_serie,
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/articulos', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'codigo', 
            'tipo_articulo_id', 
            'talle_id', 
            'nro_serie',
            'marca_id',
            'modelo_id'
        ]);
    }

	public function test_unauthorized_user_cannot_store_articulo()
	{
		$response = $this->postJson('/api/articulos', []);

        $response->assertStatus(401); // Unauthorized
	}

	public function test_user_can_store_articulo()
    {
        $user = $this->createStubUser();

        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca =  Marca::factory()->create();
        $modelo =  Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $data = [
            'descripcion' => 'Articulo test',
            'codigo' => 1,
            'observacion' => "",
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'nro_serie' => 123,
            'disponible' => true,
            'es_generico' => false
        ];

        // ES NECESARIO EN EL ACTING AS PONERLE EL GUARD, SINO VA AL DEFAULT (OBVIO xD)
        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/articulos", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "observacion" => null,
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
        ]);
        
        $this->assertDatabaseHas('articulo', [
            "id" => $response['id'],
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
        ]);
    }

    /** @test */
    public function test_user_can_es_generico_articulo()
    {
        $user = $this->createStubUser();

        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca =  Marca::factory()->create();
        $modelo =  Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        $data = [
            'descripcion' => 'Articulo test',
            'codigo' => "001",
            'observacion' => "",
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'nro_serie' => null,
            'disponible' => true,
            'es_generico' => true,
            'stock' => 0
        ];

        // ES NECESARIO EN EL ACTING AS PONERLE EL GUARD, SINO VA AL DEFAULT (OBVIO xD)
        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/articulos", $data);

        $response->assertStatus(201);
        $response->assertJson([
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "observacion" => null,
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
        ]);
        
        $this->assertDatabaseHas('articulo', [
            "id" => $response['id'],
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "nro_serie" => $data['nro_serie'],
            "disponible" => $data['disponible'],
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
        ]);

        $this->assertDatabaseHas('inventario', [
            'articulo_id' => $response['id'],
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'stock' => 0
        ]);
    }

    public function test_articulo_observer_updates_stock_on_create()
    {
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

        // Check if the stock was incremented by 1
        $this->assertDatabaseHas('inventario', [
            'talle_id' => $talle->id,
            'tipo_articulo_id' => $tipo_articulo->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id,
            'stock' => 1
        ]);
    }
}