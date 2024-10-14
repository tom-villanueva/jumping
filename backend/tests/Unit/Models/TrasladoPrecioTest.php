<?php

namespace Tests\Unit;

use App\Models\TrasladoPrecio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class TrasladoPrecioTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_traslado_precios_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new TrasladoPrecio(), 
            fillable: [
                'id',
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'traslado_precios'
        );
    }

    /* Tests de relaciones */
}