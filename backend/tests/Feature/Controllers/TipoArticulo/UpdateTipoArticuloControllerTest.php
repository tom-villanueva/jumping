<?php

namespace Tests\Feature;

use App\Models\Articulo;
use App\Models\Marca;
use App\Models\Talle;
use App\Models\TipoArticulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateTipoArticuloControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    /** @test */
    public function test_cannot_update_tipo_articulo_talles_with_associated_articulos()
    {
        $user = $this->createStubUser();

        $tipo = TipoArticulo::factory()->create();
        $talle1 = Talle::factory()->create();
        $talle2 = Talle::factory()->create();

        $tipo->talles()->attach([$talle1->id, $talle2->id]);

        $articulo = Articulo::factory()->create([
            'tipo_articulo_id' => $tipo->id,
            'talle_id' => $talle1->id, 
        ]);

        $data = [
            'descripcion' => 'nueva desc',
            'talle_ids' => [
                ['talle_id' => $talle2->id]
            ]
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/tipo-articulos/{$tipo->id}", $data);

        $response->assertStatus(422);
    }
}