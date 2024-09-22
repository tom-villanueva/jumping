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

class UpdateModeloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_modelo_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $modelo = Modelo::factory()->create();
        $modelo2 = Modelo::factory()->create();

        $data = [
            // ejemplo unique descripcion
            'descripcion' => $modelo->descripcion,
            'marca_id' => $modelo->marca_id
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/modelos/{$modelo2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['descripcion']);
    }

    public function test_unauthorized_user_can_not_update_modelo()
    {
        $modelo = Modelo::factory()->create();

        $data = [
            /* rellenar */
        ];

        $response = $this->putJson("/api/modelos/{$modelo->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_modelo()
    {
        $user = $this->createStubUser();

        $modelo = Modelo::factory()->create();

        $data = [
            'descripcion' => 'nueva desc',
            'marca_id' => Marca::factory()->create()->id
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/modelos/{$modelo->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'descripcion' => $data['descripcion'],
            'marca_id' => $data['marca_id']
        ]);
        
        $this->assertDatabaseHas('modelo', [
            "id" => $response['id'],
        ]);
    }

    public function test_change_marca_id_triggers_observer()
    {
        $user = $this->createStubUser();
        // arrange
        $tipo_articulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();
        $marca = Marca::factory()->create();
        $modelo = Modelo::factory()->create([
            'marca_id' => $marca->id
        ]);

        Articulo::factory()->count(10)->create([
            'tipo_articulo_id' => $tipo_articulo->id,
            'talle_id' => $talle->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id
        ]);
        
        $inventario = Inventario::where('tipo_articulo_id', $tipo_articulo->id)
            ->where('talle_id', $talle->id)
            ->where('marca_id', $marca->id)
            ->where('modelo_id', $modelo->id)
            ->first();

        $talle2 = Talle::factory()->create();
        Articulo::factory()->count(10)->create([
            'tipo_articulo_id' => $tipo_articulo->id,
            'talle_id' => $talle2->id,
            'marca_id' => $marca->id,
            'modelo_id' => $modelo->id
        ]);

        $inventario2 = Inventario::where('tipo_articulo_id', $tipo_articulo->id)
            ->where('talle_id', $talle2->id)
            ->where('marca_id', $marca->id)
            ->where('modelo_id', $modelo->id)
            ->first();

        // act
        $newMarca = Marca::factory()->create();
        $data = [
            'descripcion' => $modelo->descripcion,
            'marca_id' => $newMarca->id
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/modelos/{$modelo->id}", $data);

        // assert
        $this->assertSoftDeleted('inventario', [
            'id' => $inventario->id
        ]);

        $inventario1_1 = Inventario::where('tipo_articulo_id', $tipo_articulo->id)
            ->where('talle_id', $talle->id)
            ->where('marca_id', $newMarca->id)
            ->where('modelo_id', $modelo->id)
            ->first();

        $this->assertDatabaseHas('inventario', [
            'id' => $inventario1_1->id,
            'stock' => 10
        ]);

        //
        $this->assertSoftDeleted('inventario', [
            'id' => $inventario2->id
        ]);

        $inventario2_1 = Inventario::where('tipo_articulo_id', $tipo_articulo->id)
            ->where('talle_id', $talle2->id)
            ->where('marca_id', $newMarca->id)
            ->where('modelo_id', $modelo->id)
            ->first();

        $this->assertDatabaseHas('inventario', [
            'id' => $inventario2_1->id,
            'stock' => 10
        ]);
    }
}