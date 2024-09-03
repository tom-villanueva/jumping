<?php

namespace Tests\Unit;

use App\Models\Equipo;
use App\Models\EquipoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class EquipoPrecioTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_equipo_precios_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new EquipoPrecio(), 
            fillable: [
                'equipo_id',
                'precio',
                'fecha_desde',
                'fecha_hasta'
            ],
            casts: [
                'id' => 'int', 
                //'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'equipo_precio'
        );
    }

    /* Tests de relaciones */
    public function test_equipo_precio_equipo_relation_is_ok()
    {
        $equipo_precio = new EquipoPrecio();
        $equipo = new Equipo();
        $relation = $equipo_precio->equipo();

        $this->assertBelongsToRelation(
            $relation,
            $equipo_precio,
            $equipo,
            'equipo_id'
        );
    }
}