<?php

namespace Tests\Unit;

use App\Models\MetodoPago;
use App\Models\Moneda;
use App\Models\Pago;
use App\Models\Reserva;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ModelTestCase;

class PagoTest extends ModelTestCase
{
    use RefreshDatabase;

    public function test_pagos_configuration_is_ok()
    {
        $this->runConfigurationAssertions(
            new Pago(), 
            fillable: [
                'total',
                'status',
                'reserva_id',
                'numero_comprobante',
                'metodo_pago_id',
                'moneda_id'
            ],
            casts: [
                'id' => 'int', 
                'deleted_at' => 'datetime' // Este es necesario cuando hay soft delete
            ],
            table: 'pagos'
        );
    }

    /* Tests de relaciones */
    public function test_pago_metodo_relation_is_ok()
    {
        $pago = new Pago();
        $metodo = new MetodoPago();
        $relation = $pago->metodo_pago();

        $this->assertBelongsToRelation(
            $relation,
            $pago,
            $metodo,
            'metodo_pago_id'
        );
    }

    public function test_pago_moneda_relation_is_ok()
    {
        $pago = new Pago();
        $moneda = new Moneda();
        $relation = $pago->moneda();

        $this->assertBelongsToRelation(
            $relation,
            $pago,
            $moneda,
            'moneda_id'
        );
    }

    public function test_pago_reserva_relation_is_ok()
    {
        $pago = new Pago();
        $reserva = new Reserva();
        $relation = $pago->reserva();

        $this->assertBelongsToRelation(
            $relation,
            $pago,
            $reserva,
            'reserva_id'
        );
    }
}