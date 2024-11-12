<?php

namespace Tests\Feature;

use App\Models\Descuento;
use App\Models\Equipo;
use App\Models\EquipoDescuento;
use App\Models\EquipoPrecio;
use App\Models\TrasladoPrecio;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithStubUserEmpleado;

class GetEquiposByFechasControllerTest extends TestCase
{
	use RefreshDatabase, WithStubUserEmpleado;

    /** @test */
    public function test_cliente_can_get_equipos_by_fechas()
    {
        $equipo = Equipo::factory()->create();

        $precio1 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => Carbon::now()->subDays(1),
            'fecha_hasta' => Carbon::now()->addDays(5)
        ]);

        $precio2 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => Carbon::now()->addDays(6),
            'fecha_hasta' => null
        ]);

        Descuento::factory()->create();

        $descuento0 = EquipoDescuento::factory()->create([
            'equipo_id' => $equipo->id,
            'dias' => 6
        ]);

        TrasladoPrecio::factory()->create([
            'precio' => 100,
            'fecha_desde' => Carbon::now()->subDays(1),
            'fecha_hasta' => null
        ]);

        $fechaDesde = Carbon::now()->format('Y-m-d');
        $fechaHasta = Carbon::now()->addDays(10)->format('Y-m-d');

        $response = $this->getJson(
            "/api/clientes/equipos?fecha_desde={$fechaDesde}&fecha_hasta={$fechaHasta}"
        );
// dd($response);
        $response->assertStatus(200);
        // dd($response->decodeResponseJson());
        // $response->assertJsonIsArray();
    }
}