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
}
