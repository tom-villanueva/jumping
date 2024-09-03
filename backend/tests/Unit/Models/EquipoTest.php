<?php

namespace Tests\Unit;

use App\Models\Descuento;
use App\Models\Equipo;
use App\Models\EquipoPrecio;
use App\Models\Reserva;
use App\Models\TipoArticulo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\ModelTestCase;

class EquipoTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_equipo_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Equipo(),
            fillable: [
                'id',
                'descripcion',
                'disponible'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            appends: [
                'thumb_url',
                'precio_vigente'
            ],
            table: 'equipo'
        );
    }

    public function test_equipo_tipo_articulo_relation_is_ok()
    {
        $equipo = new Equipo();
        $tipoArticulo = new TipoArticulo();

        $relation = $equipo->equipo_tipo_articulo();

        $this->assertBelongsToManyRelation(
            $relation,
            $equipo,
            $tipoArticulo,
            'equipo_tipo_articulo',
            'equipo_id',
            'tipo_articulo_id',
            'id',
            'id'
        );
    }

    public function test_equipo_precio_relation_is_ok()
    {
        $equipo = new Equipo();
        $precio = new EquipoPrecio();

        $relation = $equipo->equipo_precio();

        $this->assertHasManyRelation(
            $relation,
            $equipo,
            $precio,
            'equipo_id'
        );
    }

    public function test_precios_of_equipo_are_in_correct_order()
    {
        $equipo = Equipo::factory()->create();

        $precio1 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => now()->subDays(2),
            'fecha_hasta' => now()->subDay()
        ]);

        $precio2 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => now(),
            'fecha_hasta' => now()
        ]);

        $precio3 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => now()->addDay(),
            'fecha_hasta' => null
        ]);

        // Que hay dos registros
        $this->assertEquals(2, $equipo->precios_vigentes->count());
        // Que el primero es el más reciente
        $this->assertEquals($precio2->id, $equipo->precios_vigentes()->first()->id);

        // Que sin precios no devuelve nada
        $equipoSinPrecio = Equipo::factory()->create();
        $this->assertEquals(0, $equipoSinPrecio->precios_vigentes->count());
    }

    public function test_precios_vigentes_returns_correct_equipo_precios_within_date_range()
    {
        // Create an Equipo instance
        $equipo = Equipo::factory()->create();

        // Create several EquipoPrecio instances with different `fecha_efectiva` values
        $equipoPrecio1 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => '2024-08-20',
            'fecha_hasta' => '2024-08-31'
        ]);

        $equipoPrecio2 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => '2024-09-01',
            'fecha_hasta' => '2024-09-10'
        ]);

        $equipoPrecio3 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => '2024-09-11',
            'fecha_hasta' => null
        ]);

        // Create a Reserva with a date range that should match the second and third EquipoPrecios
        $reserva = Reserva::factory()->create([
            'fecha_desde' => '2024-09-05',
            'fecha_hasta' => '2024-09-12',
        ]);

        $equipoPrecios = $equipo->precios_vigentes_en_rango(
            $reserva->fecha_desde, 
            $reserva->fecha_hasta
        )->get();

        // Assert that only the correct EquipoPrecios are returned
        $this->assertCount(2, $equipoPrecios);
        $this->assertTrue($equipoPrecios->contains($equipoPrecio2));
        $this->assertTrue($equipoPrecios->contains($equipoPrecio3));
        $this->assertFalse($equipoPrecios->contains($equipoPrecio1));
    }

    public function test_equipo_descuento_relation_is_ok()
    {
        $equipo = New Equipo();
        $descuento = new Descuento();

        $relation = $equipo->equipo_descuento();

        $this->assertBelongsToManyRelation(
            $relation,
            $equipo,
            $descuento,
            "equipo_descuento",
            "equipo_id",
            "descuento_id",
            "id",
            "id",
            function($query, $model, BelongsToMany $relation) {
                $this->assertTrue($query->getQuery()->wheres[1]['type'] === 'Null');
                $this->assertTrue($query->getQuery()->wheres[1]['column'] === 'equipo_descuento.deleted_at');

                $pivotColumns = ['id', 'fecha_desde', 'fecha_hasta', 'deleted_at'];
                foreach ($pivotColumns as $column) {
                    $this->assertContains($column, $relation->getPivotColumns());
                }
            }
        );
    }

    public function test_equipo_descuento_trashed_relation_is_ok()
    {
        $equipo = new Equipo();
        $descuento = new Descuento();

        $relation = $equipo->equipo_descuento_trashed();

        $this->assertBelongsToManyRelation(
            $relation,
            $equipo,
            $descuento,
            'equipo_descuento',
            'equipo_id',
            'descuento_id',
            'id',
            'id',
            function($query, $model, $relation) {
                $pivotColumns = ['id', 'fecha_desde', 'fecha_hasta', 'deleted_at'];
                foreach ($pivotColumns as $column) {
                    $this->assertContains($column, $relation->getPivotColumns());
                }
            }
        );
    }

    public function test_equipo_descuentos_vigentes_are_ordered()
    {
        $equipo = Equipo::factory()->create();

        $descuentoVigente1 = Descuento::factory()->create();
        $descuentoVigente2 = Descuento::factory()->create();
        $descuentoNoVigente = Descuento::factory()->create();

        $today1 = Carbon::now();
        $today2 = Carbon::now();
        $today3 = Carbon::now();

        $equipo->equipo_descuento()->attach([
            $descuentoVigente1->id => [
                'fecha_desde' => $today1->format('Y-m-d'),
                'fecha_hasta' => $today1->addDays(5)->format('Y-m-d')
            ],
            $descuentoVigente2->id => [
                'fecha_desde' => $today2->addDays(6)->format('Y-m-d'),
                'fecha_hasta' => $today2->addDays(10)->format('Y-m-d')
            ],
            $descuentoNoVigente->id => [
                'fecha_desde' => $today3->subDays(10)->format('Y-m-d'),
                'fecha_hasta' => $today3->subDays(5)->format('Y-m-d')
            ],
        ]);

        // Que solo trae los vigentes = 2
        $this->assertEquals(2, $equipo->descuentos_vigentes->count());
        // Que los trae ordenados por fecha_hasta asc
        $this->assertEquals($descuentoVigente1->id, $equipo->descuentos_vigentes()->first()->id);
    }

    public function test_returns_correct_thumb_url()
    {
        // Create an Equipo instance
        $equipo = Equipo::factory()->create();

        // Manually create and attach media to the Equipo instance
        Storage::fake('public');
        $file = UploadedFile::fake()->image('thumb.jpg');
        $media = $equipo->addMedia($file)
                        ->toMediaCollection('thumbnail', 'public');

        // Refresh the equipo instance to load the media relationship
        $equipo->refresh();

        $this->assertEquals($media->getUrl('thumb'), $equipo->thumb_url);

        // Test without media
        $equipoWithoutMedia = Equipo::factory()->create();
        $this->assertEquals('', $equipoWithoutMedia->thumb_url);
    }

    public function test_returns_correct_precio_vigente()
    {
        $equipo = Equipo::factory()->create();

        // Create EquipoPrecio records
        $precio1 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => now()->subDays(2),
            'fecha_hasta' => now()->subDay()
        ]);
        $precio2 = EquipoPrecio::factory()->create([
            'equipo_id' => $equipo->id,
            'fecha_desde' => now(),
            'fecha_hasta' => null
        ]);

        $this->assertEquals($precio2->id, $equipo->precio_vigente->id);

        // Test without any precio
        $equipoWithoutPrecio = Equipo::factory()->create();
        $this->assertNull($equipoWithoutPrecio->precio_vigente);
    }

    public function test_equipo_reserva_relation_is_ok()
    {
        $equipo = New Equipo();
        $reserva = new Reserva();

        $relation = $equipo->reservas();

        $this->assertBelongsToManyRelation(
            $relation,
            $equipo,
            $reserva,
            "reserva_equipo",
            "equipo_id",
            "reserva_id",
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
}
