<?php

namespace Tests\Unit;

use App\Models\Estado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class EstadoTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_estados_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Estado(), 
            fillable: [
                'descripcion',
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'estados'
        );
    }

    /* Tests de relaciones */
}