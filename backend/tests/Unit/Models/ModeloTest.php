<?php

namespace Tests\Unit;

use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class ModeloTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_modelos_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Modelo(), 
            fillable: [
                'descripcion',
                'marca_id',
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'modelo'
        );
    }

    /* Tests de relaciones */
    public function test_modelo_marca_relation_is_ok()
    {
        $modelo = new Modelo();
        $marca = new Marca();
        $relation = $modelo->marca();

        $this->assertBelongsToRelation(
            $relation,
            $modelo,
            $marca,
            'marca_id'
        );
    }
}