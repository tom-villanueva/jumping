<?php

namespace Tests\Unit;

use App\Models\Marca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class MarcaTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_marcas_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Marca(), 
            fillable: [
                'descripcion',
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'marca'
        );
    }

    /* Tests de relaciones */
}