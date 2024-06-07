<?php

namespace Tests\Unit;

use App\Models\Equipo;
use App\Models\Talle;
use App\Models\TipoArticulo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class TipoArticuloTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_tipo_articulo_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new TipoArticulo(),
            fillable: [
                'id',
                'descripcion'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'tipo_articulos'
        );
    }

    public function test_tipo_articulo_talle_relation_is_ok()
    {
        $tipoArticulo = new TipoArticulo();
        $talle = new Talle();

        $relation = $tipoArticulo->tipo_articulo_talle();

        $this->assertBelongsToManyRelation(
            $relation,
            $tipoArticulo,
            $talle,
            'tipo_articulo_talle',
            'tipo_articulo_id',
            'talle_id',
            'id',
            'id',
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

    public function test_equipo_tipo_articulo_relation_is_ok()
    {
        $tipoArticulo = new TipoArticulo();
        $equipo = new Equipo();

        $relation = $tipoArticulo->equipo_tipo_articulo();

        $this->assertBelongsToManyRelation(
            $relation,
            $tipoArticulo,
            $equipo,
            'equipo_tipo_articulo',
            'tipo_articulo_id',
            'equipo_id',
            'id',
            'id'
        );
    }

    public function test_tipo_articulo_belongs_to_many_talle()
    {
        $tipoArticulo = TipoArticulo::factory()->create();
        $talle = Talle::factory()->create();

        $stock = 10;
        $tipoArticulo->tipo_articulo_talle()->attach($talle, ['stock' => $stock]);

        // Que lo tiene
        $this->assertTrue($tipoArticulo->tipo_articulo_talle->contains($talle));
        // Que lo devuelve
        $this->assertEquals(1, $tipoArticulo->tipo_articulo_talle->count());
        // Que efectivamente es el modelo que tiene que ser
        $this->assertInstanceOf(Talle::class, $tipoArticulo->tipo_articulo_talle()->first());
        // Que los valores del pivot se setean
        $this->assertEquals($stock, $tipoArticulo->tipo_articulo_talle()->first()->pivot->stock);
    }
}
