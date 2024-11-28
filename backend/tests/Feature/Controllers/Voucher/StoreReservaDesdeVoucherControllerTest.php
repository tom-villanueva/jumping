<?php

namespace Tests\Feature;

use App\Models\Equipo;
use App\Models\EquipoPrecio;
use App\Models\EquipoVoucher;
use App\Models\ReservaEquipo;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class StoreReservaDesdeVoucherControllerTest extends TestCase
{
    use RefreshDatabase, WithStubUserEmpleado;

    public function test_user_can_store_reserva_desde_voucher()
    {
        $user = $this->createStubUser();

        $voucher = Voucher::factory()->create();

        $equipos = Equipo::factory()->count(2)->create();
        $reservaEquipos = $equipos->map(function ($equipo) use ($voucher) {
            $reservaEquipo = ReservaEquipo::factory()->create([
                'equipo_id' => $equipo->id,
            ]);
            
            $equipoPrecio = EquipoPrecio::factory()->create([
                'equipo_id' => $equipo->id,
                'precio' => 100
            ]);

            $equipoVoucher = EquipoVoucher::create([
                'equipo_id' => $equipo->id,
                'voucher_id' => $voucher->id
            ]);

            // ReservaEquipoPrecio::factory()->create([
            //     'reserva_equipo_id' => $reservaEquipo->id,
            //     'equipo_precio_id' => $equipoPrecio->id,
            //     'fecha_desde' => $equipoPrecio->fecha_desde,
            //     'fecha_hasta' => $equipoPrecio->fecha_desde
            // ]);

            return $reservaEquipo;
        });

        $data = [
            'voucher_id' => $voucher->id,
            'fecha_desde' => Carbon::today()->format('Y-m-d'),
            'fecha_hasta' => Carbon::today()->addDay(2)->format('Y-m-d'),
            'fecha_prueba' => '',
        ];

        $response = $this->actingAs($user, $user->getModelGuard())->postJson("/api/vouchers/crear-reserva", $data);

        $response->assertStatus(201);
        $response->assertJson([
            'fecha_prueba' => $data['fecha_prueba'],
            'fecha_desde' => $data['fecha_desde'],
            'fecha_hasta' => $data['fecha_hasta'],
            'cliente_id' => $voucher->cliente_id
        ]);

        $this->assertDatabaseHas('reservas', [
            "id" => $response['id'],
        ]);

        $this->assertDatabaseHas('vouchers', [
            "reserva_id" => $response['id'],
        ]);

        foreach ($reservaEquipos as $reservaEquipo) {
            $this->assertDatabaseHas('reserva_equipo', [
                'reserva_id' => $response["id"],
                'equipo_id' => $reservaEquipo->equipo_id,
            ]);
        }
    }
}
