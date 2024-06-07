<?php

namespace Tests\Unit;

use App\Models\Descuento;
use App\Models\Equipo;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class DescuentoTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_descuento_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Descuento(), 
            fillable: [
                'valor',
                'descripcion',
                'tipo_descuento'
            ],
            table: 'descuentos'
        );
    }

    public function test_equipo_descuento_relation_is_ok()
    {
        $descuento = new Descuento();
        $equipo = new Equipo();

        $relation = $descuento->equipo_descuento();

        $this->assertBelongsToManyRelation(
            $relation,
            $descuento,
            $equipo,
            'equipo_descuento',
            'descuento_id',
            'equipo_id',
            'id',
            'id',
            function($query, $model, $relation) {
                // EL PRIMER WHERES SIEMPRE ES relationName.model_id = ?
                // LOS SUBSIGUIENTES WHERES SON LOS AGREGADOS POR NOSOTROS
                // POR EJEMPLO EL wherePivotNull -> wheres[1]
                $this->assertTrue($query->getQuery()->wheres[1]['type'] === 'Null');
                $this->assertTrue($query->getQuery()->wheres[1]['column'] === 'equipo_descuento.deleted_at');

                $pivotColumns = ['fecha_desde', 'fecha_hasta', 'deleted_at'];
                foreach ($pivotColumns as $column) {
                    $this->assertContains($column, $relation->getPivotColumns());
                }
            }
        );
    }

    public function test_equipo_descuento_trashed_relation_is_ok()
    {
        $descuento = new Descuento();
        $equipo = new Equipo();

        $relation = $descuento->equipo_descuento_trashed();

        $this->assertBelongsToManyRelation(
            $relation,
            $descuento,
            $equipo,
            'equipo_descuento',
            'descuento_id',
            'equipo_id',
            'id',
            'id',
            function($query, $model, $relation) {
                $pivotColumns = ['fecha_desde', 'fecha_hasta', 'deleted_at'];
                foreach ($pivotColumns as $column) {
                    $this->assertContains($column, $relation->getPivotColumns());
                }
            }
        );
    }

    public function test_descuento_belongs_to_many_equipo()
    {
        $descuento = Descuento::factory()->create();
        $equipo = Equipo::factory()->create();

        $today = Carbon::today();
        $todayMasCinco = Carbon::today()->addDays(5);
        $descuento->equipo_descuento()->attach($equipo, [
            'fecha_desde' => $today,
            'fecha_hasta' => $todayMasCinco
        ]);

        // Que lo tiene
        $this->assertTrue($descuento->equipo_descuento->contains($equipo));
        // Que lo devuelve
        $this->assertEquals(1, $descuento->equipo_descuento->count());
        // Que efectivamente es el modelo que tiene que ser
        $this->assertInstanceOf(Equipo::class, $descuento->equipo_descuento()->first());
        // Que los valores del pivot se setean
        $this->assertEquals(
            $today->format('Y-m-d'), 
            $descuento->equipo_descuento()->first()->pivot->fecha_desde
        );
        $this->assertEquals(
            $todayMasCinco->format('Y-m-d'), 
            $descuento->equipo_descuento()->first()->pivot->fecha_hasta
        );
    }
}
