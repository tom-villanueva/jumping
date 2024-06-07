<?php

namespace Tests\Unit;

use App\Models\Talle;
use App\Models\TipoArticulo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class TalleTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_talle_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Talle(), 
            fillable: [
                'id',
                'descripcion'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'talle'
        );
    }

    public function test_tipo_articulo_talle_relation_is_ok()
    {        
        $talle = new Talle();
        $tipoArticulo = new TipoArticulo();

        $relation = $talle->tipo_articulo_talle();

        $this->assertBelongsToManyRelation(
            $relation,
            $talle,
            $tipoArticulo,
            'tipo_articulo_talle',   // intermediate table
            'talle_id',              // foreign key on the pivot table
            'tipo_articulo_id',      // related key on the pivot table
            'id',                    // primary key on the talle table
            'id',                    // primary key on the tipo_articulo table
            function($query, $model, BelongsToMany $relation) {
                /**
                 * Esta parte del código es verificar que la relación tiene esas columnas pivot
                 */
                $pivotColumns = ['stock'];
                foreach ($pivotColumns as $column) {
                    $this->assertContains($column, $relation->getPivotColumns());
                }
            }
        );
    }

    public function test_talle_belongs_to_many_tipo_articulo()
    {
        $talle = Talle::factory()->create();
        $tipoArticulo = TipoArticulo::factory()->create();

        $stock = 10;
        $talle->tipo_articulo_talle()->attach($tipoArticulo, ['stock' => $stock]);

        // Que lo tiene
        $this->assertTrue($talle->tipo_articulo_talle->contains($tipoArticulo));
        // Que lo devuelve
        $this->assertEquals(1, $talle->tipo_articulo_talle->count());
        // Que efectivamente es el modelo que tiene que ser
        $this->assertInstanceOf(TipoArticulo::class, $talle->tipo_articulo_talle()->first());
        // Que los valores del pivot se setean
        $this->assertEquals($stock, $talle->tipo_articulo_talle()->first()->pivot->stock);
    }
}