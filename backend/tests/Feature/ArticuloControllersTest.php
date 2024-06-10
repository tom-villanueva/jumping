<?php

namespace Tests\Feature;

use App\Models\TipoArticuloTalle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class ArticuloControllersTest extends TestCase
{
    use RefreshDatabase, WithStubUserEmpleado;

    public function test_user_can_store_articulo()
    {
        $user = $this->createStubUser();
        $tipoArticuloTalle = TipoArticuloTalle::factory()->create();

        $data = [
            'descripcion' => 'Articulo test',
            'codigo' => 1,
            'observacion' => "",
            'tipo_articulo_talle_id' => $tipoArticuloTalle->id
        ];

        // ES NECESARIO EN EL ACTING AS PONERLE EL GUARD, SINO VA AL DEFAULT (OBVIO xD)
        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/articulos", $data);

        $response->assertStatus(200);
        $response->assertJson([
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
            "observacion" => null,
            "tipo_articulo_talle_id" => $data['tipo_articulo_talle_id']
        ]);
        
        $this->assertDatabaseHas('articulo', [
            "id" => $response['id'],
            "descripcion" => $data['descripcion'],
            "codigo" => $data['codigo'],
        ]);
    }

    public function test_unauthenticated_user_can_not_store_articulo()
    {
        $tipoArticuloTalle = TipoArticuloTalle::factory()->create();

        $data = [
            'descripcion' => 'Articulo test',
            'codigo' => 1,
            'observacion' => "",
            'tipo_articulo_talle_id' => $tipoArticuloTalle->id
        ];

        $response = $this->postJson("/api/articulos", $data);

        $response->assertStatus(401);
    }
}
