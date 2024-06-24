<?php

namespace Tests\Feature;

use App\Models\Descuento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class UpdateDescuentoControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_descuento_update()
    {
        // Arrange
		$user = $this->createStubUser();

        $descuento = Descuento::factory()->create();
        $descuento2 = Descuento::factory()->create();

        $data = [
            'valor' => $descuento->valor, // Valor es unique
            'descripcion' => $descuento2->descripcion,
            'tipo_descuento' => $descuento2->tipo_descuento
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())
                         ->putJson("api/descuentos/{$descuento2->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['valor']);
    }

    public function test_unauthorized_user_can_not_update_descuento()
    {
        $descuento = Descuento::factory()->create();

        $data = [
            'valor' => $descuento->valor,
            'descripcion' => $descuento->descripcion,
            'tipo_descuento' => $descuento->tipo_descuento
        ];

        $response = $this->putJson("/api/descuentos/{$descuento->id}", $data);

        $response->assertStatus(401);
    }

    public function test_user_can_update_descuento()
    {
        $user = $this->createStubUser();

        $descuento = Descuento::factory()->create();

        $data = [
            'valor' => $descuento->valor + 10,
            'descripcion' => $descuento->descripcion,
            'tipo_descuento' => $descuento->tipo_descuento
        ];

        $response = $this->actingAs($user, $user->getModelGuard())
                        ->putJson("/api/descuentos/{$descuento->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'valor' => $data['valor'],
            'descripcion' => $data['descripcion'],
            'tipo_descuento' => $data['tipo_descuento']
        ]);
        
        $this->assertDatabaseHas('descuentos', [
            "id" => $response['id'],
            'valor' => $response['valor'],
            'descripcion' => $response['descripcion'],
            'tipo_descuento' => $response['tipo_descuento']
        ]);
    }
}