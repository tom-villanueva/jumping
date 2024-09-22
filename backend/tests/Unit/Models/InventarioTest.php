<?php

namespace Tests\Unit;

use App\Models\Inventario;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Talle;
use App\Models\TipoArticulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class InventarioTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_inventarios_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Inventario(), 
            fillable: [
                'tipo_articulo_id',
                'talle_id',
                'marca_id',
                'modelo_id',
                'stock'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'inventario'
        );
    }

    /* Tests de relaciones */
    public function test_inventario_tipo_articulo_relation_is_ok()
    {
        $inventario = new Inventario();
        $tipoArticulo = new TipoArticulo();
        $relation = $inventario->tipo_articulo();

        $this->assertBelongsToRelation(
            $relation,
            $inventario,
            $tipoArticulo,
            'tipo_articulo_id'
        );
    }

    public function test_inventario_talle_relation_is_ok()
    {
        $inventario = new Inventario();
        $talle = new Talle();
        $relation = $inventario->talle();

        $this->assertBelongsToRelation(
            $relation,
            $inventario,
            $talle,
            'talle_id'
        );
    }

    public function test_inventario_marca_relation_is_ok()
    {
        $inventario = new Inventario();
        $marca = new Marca();
        $relation = $inventario->marca();

        $this->assertBelongsToRelation(
            $relation,
            $inventario,
            $marca,
            'marca_id'
        );
    }

    public function test_inventario_modelo_relation_is_ok()
    {
        $inventario = new Inventario();
        $modelo = new Modelo();
        $relation = $inventario->modelo();

        $this->assertBelongsToRelation(
            $relation,
            $inventario,
            $modelo,
            'modelo_id'
        );
    }
}