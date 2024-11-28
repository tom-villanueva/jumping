<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\EquipoPrecio;
use App\Models\Reserva;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoPrecio;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreVoucherControllerTest extends TestCase
{
    use RefreshDatabase, WithStubUserEmpleado;

    public function test_validation_fails_voucher()
    {
        // Arrange
        $user = $this->createStubUser();

        $data = [
            'descripcion' => '',
            'fecha_expiracion' => null,
            'dias' => null,
            'reserva_id' => 2455,
            'cliente_id' => 12,
            'equipos' => null
        ];

        // Act
        $response = $this->actingAs($user, $user->getModelGuard())->postJson('api/vouchers', $data);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['fecha_expiracion', 'dias', 'reserva_id', 'cliente_id', 'equipos']);
    }

    public function test_unauthorized_user_cannot_store_voucher()
    {
        $response = $this->postJson('/api/vouchers', [
            /* rellenar */]);

        $response->assertStatus(401); // Unauthorized
    }

    public function test_user_can_store_voucher()
    {
        $user = $this->createStubUser();

        $reserva = Reserva::factory()->create();

        $equipos = Equipo::factory()->count(2)->create();
        $reservaEquipos = $equipos->map(function ($equipo) use ($reserva) {
            $reservaEquipo = ReservaEquipo::factory()->create([
                'reserva_id' => $reserva->id,
                'equipo_id' => $equipo->id,
            ]);

            $equipoPrecio = EquipoPrecio::factory()->create([
                'equipo_id' => $equipo->id,
                'precio' => 100
            ]);

            ReservaEquipoPrecio::factory()->create([
                'reserva_equipo_id' => $reservaEquipo->id,
                'equipo_precio_id' => $equipoPrecio->id,
                'fecha_desde' => $equipoPrecio->fecha_desde,
                'fecha_hasta' => $equipoPrecio->fecha_desde
            ]);

            return $reservaEquipo;
        });

        $data = [
            'descripcion' => 'hola',
            'fecha_expiracion' => Carbon::today()->addDays(10)->format('Y-m-d'),
            'dias' => 2,
            'reserva_id' => $reserva->id,
            'cliente_id' => Cliente::factory()->create()->id,
            'equipos' => $reservaEquipos
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/vouchers", $data);

        $response->assertStatus(201);
        $response->assertJson([
            'descripcion' => $data['descripcion'],
            'fecha_expiracion' => $data['fecha_expiracion'],
            'dias' => $data['dias'],
            'reserva_id' => $data['reserva_id'],
            'cliente_id' => $data['cliente_id']
        ]);

        $this->assertDatabaseHas('vouchers', [
            "id" => $response['id'],
        ]);

        foreach ($reservaEquipos as $reservaEquipo) {
            $this->assertDatabaseHas('equipo_voucher', [
                "voucher_id" => $response['id'],
                'equipo_id' => $reservaEquipo->equipo_id,
                'precio' => 100
            ]);
        }
    }
}
