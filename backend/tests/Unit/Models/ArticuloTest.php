<?php

namespace Tests\Unit;

use App\Models\Articulo;
use App\Models\TipoArticuloTalle;
use Tests\ModelTestCase;

class ArticuloTest extends ModelTestCase
{
    public function test_articulo_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Articulo(),
            fillable: [
                'id',
                'descripcion',
                'codigo',
                'observacion',
                'tipo_articulo_talle_id',
                'nro_serie',
                'disponible'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime'
            ],
            table: 'articulo'
        );
    }

    public function test_articulo_tipo_articulo_talle_relation_is_ok()
    {
        $articulo = new Articulo();
        $tipoArticuloTalle = new TipoArticuloTalle();
        $relation = $articulo->tipo_articulo_talle();

        $this->assertBelongsToRelation(
            $relation,
            $articulo,
            $tipoArticuloTalle,
            'tipo_articulo_talle_id'
        );
    }
}
