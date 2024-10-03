<?php

namespace Tests\Unit;

use App\Models\Equipo;
use App\Models\EquipoDescuento;
use App\Models\EquipoPrecio;
use App\Models\Reserva;
use App\Models\ReservaEquipo;
use App\Models\ReservaEquipoDescuento;
use App\Models\ReservaEquipoPrecio;
use App\Models\ReservaEstado;
use App\Models\Traslado;
use App\Models\User;
use App\Repositories\Reserva\ReservaRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class ReservaTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_reservas_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Reserva(), 
            fillable: [
                'fecha_prueba',
                'fecha_desde',
                'fecha_hasta',
                'comentario',
                'user_id',
                'nombre',
                'apellido',
                'email',
                'telefono'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'reservas',
            appends: [
                'estado_actual',
                'precio_total'
            ]
        );
    }

    /* Tests de relaciones */
    public function test_reserva_user_relation_is_ok()
    {
        $reserva = new Reserva();
        $user = new User();
        $relation = $reserva->user();

        $this->assertBelongsToRelation(
            $relation,
            $reserva,
            $user,
            'user_id'
        );
    }

    // relacion estado

    public function test_reserva_traslado_relation_is_ok()
    {
        $reserva = new Reserva();
        $traslado = new Traslado();

        $relation = $reserva->traslados();

        $this->assertHasManyRelation(
            $relation,
            $reserva,
            $traslado,
            'reserva_id'
        );
    }

    public function test_reserva_equipo_relation_is_ok()
    {
        $reserva = new Reserva();
        $equipo = New Equipo();

        $relation = $reserva->equipos();

        $this->assertBelongsToManyRelation(
            $relation,
            $reserva,
            $equipo,
            "reserva_equipo",
            "reserva_id",
            "equipo_id",
            "id",
            "id",
            function($query, $model, BelongsToMany $relation) {
                $this->assertTrue($query->getQuery()->wheres[1]['type'] === 'Null');
                $this->assertTrue($query->getQuery()->wheres[1]['column'] === 'reserva_equipo.deleted_at');

                $pivotColumns = ['id', 'altura', 'peso', 'nombre', 'apellido', 'num_calzado'];
                foreach ($pivotColumns as $column) {
                    $this->assertContains($column, $relation->getPivotColumns());
                }
            }
        );
    }

    public function test_can_get_reservas_with_scope_dates()
    {
        $reserva1 = Reserva::factory()->create([
            'fecha_desde' => '2024-07-15',
            'fecha_hasta' => '2024-07-20'
        ]);
        $reserva2 = Reserva::factory()->create([
            'fecha_desde' => '2024-07-15',
            'fecha_hasta' => '2024-07-20'
        ]);
        $reserva3 = Reserva::factory()->create([
            'fecha_desde' => '2024-07-10',
            'fecha_hasta' => '2024-07-14'
        ]);
        $reserva4 = Reserva::factory()->create([
            'fecha_desde' => '2024-07-13',
            'fecha_hasta' => '2024-07-17'
        ]);

        $repository = new ReservaRepository(new Reserva(), request());

        $result1 = $repository->get([
            'filter' => [
                'fecha_desde_after' => '2024-07-15'
            ]
        ]);

        $this->assertCount(2, $result1);
        
        $result2 = $repository->get([
            'filter' => [
                'fecha_desde_between' => '2024-07-13,2024-07-15'
            ]
        ]);
        
        $this->assertCount(3, $result2);
    }

    public function test_can_get_reserva_estados()
    {
        $reserva = Reserva::factory()->create();
        $reservaEstado = ReservaEstado::factory()->create([
            'reserva_id' => $reserva->id,
            'estado_id' => 1,
            'created_at' => Carbon::today()
        ]);

        $reservaEstado = ReservaEstado::factory()->create([
            'reserva_id' => $reserva->id,
            'estado_id' => 2,
            'created_at' => Carbon::today()->addDay()
        ]);

        $estados = $reserva->estados()->get();

        $this->assertCount(2, $estados);

        $this->assertEquals(1, $reserva->estado_actual->id);
    }

    /** @test */
    public function it_calculates_total_price_without_discounts()
    {
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

        // Call the getTotalPrice method
        $totalPrice = $reserva->calculateTotalPrice();

        // Total price should be 6 days * 100 = 600
        $this->assertEquals(600, $totalPrice);
    }

    /** @test */
    public function it_calculates_total_price_with_discounts()
    {
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
            'fecha_hasta' => Carbon::now()->addDays(10),
            'precio' => 100,
        ]);

        ReservaEquipoPrecio::factory()->create([
            'reserva_equipo_id' => $reservaEquipo->id,
            'equipo_precio_id' => $equipoPrecio->id,
            'fecha_desde' => $equipoPrecio->fecha_desde,
            'fecha_hasta' => $equipoPrecio->fecha_hasta ?? $reserva->fecha_hasta,
            'precio' => $equipoPrecio->precio,
        ]);

        // Create related EquipoDescuento for ReservaEquipo
        $equipoDescuento = EquipoDescuento::factory()->create([
            'descuento_id' => 2,
            'equipo_id' => $equipo->id,
            'dias' => 6
            // 'fecha_desde' => Carbon::now()->subDays(2),
            // 'fecha_hasta' => Carbon::now()->addDays(2),
        ]);

        ReservaEquipoDescuento::factory()->create([
            'reserva_equipo_id' => $reservaEquipo->id,
            'equipo_descuento_id' => $equipoDescuento->id,
            'dias' => $equipoDescuento->dias,
            // 'fecha_desde' => $equipoDescuento->fecha_desde,
            // 'fecha_hasta' => $equipoDescuento->fecha_hasta,
            'descuento' => $equipoDescuento->descuento->valor,
        ]);

        // Call the getTotalPrice method
        $totalPrice = $reserva->calculateTotalPrice();
        // dd($totalPrice);
        $this->assertEquals(480, $totalPrice);
    }

    /** @test */
    public function it_calculates_total_price_with_overlapping_precios()
    {
        $equipo = Equipo::factory()->create();
        // Set up the reservation with specific date range (e.g., 5 days)
        $reserva = Reserva::factory()->create([
            'fecha_desde' => Carbon::now()->subDays(5),
            'fecha_hasta' => Carbon::now(),
        ]);

        // Create related ReservaEquipo
        $reservaEquipo = ReservaEquipo::factory()->create([
            'equipo_id' => $equipo->id,
            'reserva_id' => $reserva->id,
        ]);

        // Create the first EquipoPrecio, valid for the first 3 days of the reservation
        $equipoPrecio1 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => Carbon::now()->subDays(10),
            'fecha_hasta' => Carbon::now()->subDays(3),
            'precio' => 100,
        ]);

        // Create the second EquipoPrecio, valid for the last 2 days of the reservation
        $equipoPrecio2 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => Carbon::now()->subDays(2),
            'fecha_hasta' => Carbon::now()->addDays(5),
            'precio' => 150,
        ]);

        // Attach both prices to the ReservaEquipo
        ReservaEquipoPrecio::factory()->create([
            'reserva_equipo_id' => $reservaEquipo->id,
            'equipo_precio_id' => $equipoPrecio1->id,
            'fecha_desde' => $equipoPrecio1->fecha_desde,
            'fecha_hasta' => $equipoPrecio1->fecha_hasta ?? $reserva->fecha_hasta,
            'precio' => $equipoPrecio1->precio,
        ]);

        ReservaEquipoPrecio::factory()->create([
            'reserva_equipo_id' => $reservaEquipo->id,
            'equipo_precio_id' => $equipoPrecio2->id,
            'fecha_desde' => $equipoPrecio2->fecha_desde,
            'fecha_hasta' => $equipoPrecio2->fecha_hasta ?? $reserva->fecha_hasta,
            'precio' => $equipoPrecio2->precio,
        ]);
    //     dd($reserva->fecha_desde->format("Y-m-d"), $reserva->fecha_hasta->format("Y-m-d"),
    //         $equipoPrecio1->fecha_desde->format("Y-m-d"), $equipoPrecio1->fecha_hasta->format("Y-m-d"),
    // $equipoPrecio2->fecha_desde->format("Y-m-d"), $equipoPrecio2->fecha_hasta->format("Y-m-d"));
        // Call the calculateTotalPrice method
        $totalPrice = $reserva->calculateTotalPrice();

        // si hoy es 26/09
        // Reserva va del 21/09 al 26/09. Son 6 dias si las fechas son inclusive.
        // precio 1 overlaps en 21, 22, 23
        // precio 2 overlaps en 24, 25, 26

        // Expected price calculation:
        // - 3 days at $100/day (for equipoPrecio1) = 3 * 100 = 300
        // - 3 days at $150/day (for equipoPrecio2) = 3 * 150 = 400
        $expectedTotalPrice = 300 + 450;
        
        // Assert that the calculated total price is correct
        $this->assertEquals($expectedTotalPrice, round($totalPrice, 2));
    }

    /** @test */
    public function it_calculates_total_price_with_overlapping_precios_and_descuentos()
    {
        $equipo = Equipo::factory()->create();
        
        // Set up the reservation with a specific date range (e.g., 6 days)
        $reserva = Reserva::factory()->create([
            'fecha_desde' => Carbon::now()->subDays(5), // 21-09
            'fecha_hasta' => Carbon::now(),             // 26-09
        ]);

        // Create related ReservaEquipo
        $reservaEquipo = ReservaEquipo::factory()->create([
            'equipo_id' => $equipo->id,
            'reserva_id' => $reserva->id,
        ]);

        // Create the first EquipoPrecio, valid for the first 3 days of the reservation (21-09 to 23-09)
        $equipoPrecio1 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => Carbon::now()->subDays(10), // 16-09
            'fecha_hasta' => Carbon::now()->subDays(3),  // 23-09
            'precio' => 100,
        ]);

        // Create the second EquipoPrecio, valid for the last 3 days of the reservation (24-09 to 26-09)
        $equipoPrecio2 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => Carbon::now()->subDays(2),  // 24-09
            'fecha_hasta' => Carbon::now()->addDays(5),  // 01-10
            'precio' => 150,
        ]);

        // Attach both prices to the ReservaEquipo
        ReservaEquipoPrecio::factory()->create([
            'reserva_equipo_id' => $reservaEquipo->id,
            'equipo_precio_id' => $equipoPrecio1->id,
            'fecha_desde' => $equipoPrecio1->fecha_desde,
            'fecha_hasta' => $equipoPrecio1->fecha_hasta ?? $reserva->fecha_hasta,
            'precio' => $equipoPrecio1->precio,
        ]);

        ReservaEquipoPrecio::factory()->create([
            'reserva_equipo_id' => $reservaEquipo->id,
            'equipo_precio_id' => $equipoPrecio2->id,
            'fecha_desde' => $equipoPrecio2->fecha_desde,
            'fecha_hasta' => $equipoPrecio2->fecha_hasta ?? $reserva->fecha_hasta,
            'precio' => $equipoPrecio2->precio,
        ]);

        // Create a discount for the overlapping period with the first EquipoPrecio
        $equipoDescuento1 = EquipoDescuento::factory()->create([
            'descuento_id' => 2, // 20% discount
            'equipo_id' => $equipo->id,
            'dias' => 6
            // 'fecha_desde' => Carbon::now()->subDays(15), // 11-09
            // 'fecha_hasta' => Carbon::now()->subDays(2),  // 24-09
        ]);

        // Create a discount for the overlapping period with the second EquipoPrecio
        // $equipoDescuento2 = EquipoDescuento::factory()->create([
        //     'descuento_id' => 1, // 10% discount
        //     'equipo_id' => $equipo->id,
            // 'fecha_desde' => Carbon::now()->subDays(1),  // 25-09
            // 'fecha_hasta' => Carbon::now()->addDays(3),  // 29-09
        // ]);

        // Attach both discounts to the ReservaEquipo
        ReservaEquipoDescuento::factory()->create([
            'reserva_equipo_id' => $reservaEquipo->id,
            'equipo_descuento_id' => $equipoDescuento1->id,
            'dias' => 6,
            // 'fecha_desde' => $equipoDescuento1->fecha_desde,
            // 'fecha_hasta' => $equipoDescuento1->fecha_hasta,
            'descuento' => $equipoDescuento1->descuento->valor,
        ]);

        // ReservaEquipoDescuento::factory()->create([
        //     'reserva_equipo_id' => $reservaEquipo->id,
        //     'equipo_descuento_id' => $equipoDescuento2->id,
        //     'fecha_desde' => $equipoDescuento2->fecha_desde,
        //     'fecha_hasta' => $equipoDescuento2->fecha_hasta,
        //     'descuento' => $equipoDescuento2->descuento->valor,
        // ]);

        // Call the calculateTotalPrice method
        $totalPrice = $reserva->calculateTotalPrice();

        // Explanation of expected total price:
        // - 3 days at $100/day (for equipoPrecio1) = 3 * (100 * 0.2) = 240
        // - 3 days at $150/day (for equipoPrecio2) = 3 * (150 * 0.2) = 360

        $expectedTotalPrice = 240 + 360;

        // Assert that the calculated total price is correct
        $this->assertEquals($expectedTotalPrice, round($totalPrice, 2));
    }
}