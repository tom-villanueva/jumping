<?php

namespace Tests\Feature;

use App\Models\Equipo;
use App\Models\EquipoPrecio;
use App\Models\Reserva;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoPrecio;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class MarcarReservaPagadaControllerTest extends TestCase
{
    use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_reserva_pagada()
    {
        // Arrange
        $user = $this->createStubUser();

        $reserva = Reserva::factory()->create();

        $data = [
            'metodo_pago_id' => 25,
            'moneda_id' => 25
        ];

        // Act
        $response = $this->actingAs(
            $user,
            $user->getModelGuard()
        )
            ->putJson("/api/reservas/marcar-pagada/{$reserva->id}", $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['metodo_pago_id', 'moneda_id']);
    }

    public function test_unauthorized_user_cannot_store_reserva()
    {
        $reserva = Reserva::factory()->create();

        $response = $this->putJson("/api/reservas/marcar-pagada/{$reserva->id}", [
            /* rellenar */]);

        $response->assertStatus(401); // Unauthorized
    }

    /** @test */
    public function test_user_can_pagar_reserva()
    {
        $user = $this->createStubUser();

        $equipo = Equipo::factory()->create();
        // Create a Reserva
        $reserva = Reserva::factory()->create([
            'fecha_desde' => Carbon::now()->subDays(5),
            'fecha_hasta' => Carbon::now(),
        ]);

        // Create related ReservaEquipo
        $reservaEquipo = ReservaEquipo::factory()->create([
            'reserva_id' => $reserva->id,
            'equipo_id' => $equipo->id,
        ]);

        // Create related EquipoPrecio for ReservaEquipo
        $equipoPrecio = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => Carbon::now()->subDays(10),
            'fecha_hasta' => null,
            'precio' => 100,
        ]);

        ReservaEquipoPrecio::factory()->create([
            'reserva_equipo_id' => $reservaEquipo->id,
            'equipo_precio_id' => $equipoPrecio->id,
            'fecha_desde' => $equipoPrecio->fecha_desde,
            'fecha_hasta' => $equipoPrecio->fecha_hasta ?? $reserva->fecha_hasta,
            'precio' => $equipoPrecio->precio,
        ]);

        $data = [
            'metodo_pago_id' => 1,
            'moneda_id' => 1,
            'tipo_persona_id' => 1,
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->putJson("/api/reservas/marcar-pagada/{$reserva->id}", $data);
        
        $response->assertStatus(201);
        $response->assertJson([
            'total' => $reserva->calculateTotalPrice() - 60 - 60, // 600
            'status' => '',
            'reserva_id' => $reserva->id,
            'numero_comprobante' => '',
            'metodo_pago_id' => $data["metodo_pago_id"],
            'moneda_id' => $data["moneda_id"],
            'tipo_persona_id' => $data["tipo_persona_id"],
            'tipo_persona_descuento' => 10,
            'metodo_pago_descuento' => 10,
        ]);

        $this->assertDatabaseHas('pagos', [
            "id" => $response['id'],
            'reserva_id' => $reserva->id,
        ]);

        $this->assertDatabaseHas('reserva_estado', [
            "reserva_id" => $response['reserva_id'],
            "estado_id" => 2
        ]);
    }
}
