<?php

namespace Tests\Unit;

use App\Models\Articulo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talle;
use App\Models\TipoArticulo;
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
                'tipo_articulo_id',
                'talle_id',
                'marca_id',
                'modelo_id',
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

    public function test_articulo_tipo_articulo_relation_is_ok()
    {
        $articulo = new Articulo();
        $tipoArticulo = new TipoArticulo();
        $relation = $articulo->tipo_articulo();

        $this->assertBelongsToRelation(
            $relation,
            $articulo,
            $tipoArticulo,
            'tipo_articulo_id'
        );
    }

    public function test_articulo_talle_relation_is_ok()
    {
        $articulo = new Articulo();
        $talle = new Talle();
        $relation = $articulo->talle();

        $this->assertBelongsToRelation(
            $relation,
            $articulo,
            $talle,
            'talle_id'
        );
    }

    public function test_articulo_marca_relation_is_ok()
    {
        $articulo = new Articulo();
        $marca = new Marca();
        $relation = $articulo->marca();

        $this->assertBelongsToRelation(
            $relation,
            $articulo,
            $marca,
            'marca_id'
        );
    }

    public function test_articulo_modelo_relation_is_ok()
    {
        $articulo = new Articulo();
        $modelo = new Modelo();
        $relation = $articulo->modelo();

        $this->assertBelongsToRelation(
            $relation,
            $articulo,
            $modelo,
            'modelo_id'
        );
    }
}
