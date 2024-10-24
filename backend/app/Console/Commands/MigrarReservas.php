<?php

namespace App\Console\Commands;

use App\Models\Pago;
use App\Models\Reserva;
use App\Models\ReservaEstado;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrarReservas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrar:reservas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrar reservas sistema viejo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        Reserva::truncate();
        Pago::truncate();
        ReservaEstado::truncate();

        $oldReservas = DB::connection('mysql_old')
            ->table('fi_reservas as fr')
            ->join('fi_usuario as fu', 'fr.res_usua_id', '=', 'fu.usua_id')
            ->where('fr.res_pagada', 1)
            ->select(
                'fr.res_fecha_inicio',
                'fr.res_fecha_fin',
                'fr.res_fecha_prueba',
                'fr.res_usua_id',
                'fu.usua_nombre',
                'fu.usua_email',
                'fr.res_forma_pago',
                DB::raw('ROUND(fr.res_importe_total, 2) as res_importe_total')
            )
            ->get();

        // Use PostgreSQL connection to insert transformed data
        DB::connection('pgsql')->transaction(function () use ($oldReservas) {
            $count = 0;
            foreach ($oldReservas as $oldReserva) {
                try {
                    // Transform the data
                    $newReserva = [
                        'fecha_prueba' => Carbon::parse($oldReserva->res_fecha_prueba)->format('Y-m-d'),
                        'fecha_desde' => Carbon::parse($oldReserva->res_fecha_inicio)->format('Y-m-d'),
                        'fecha_hasta' => Carbon::parse($oldReserva->res_fecha_fin)->format('Y-m-d'),
                        'comentario' => '',
                        'user_id' => null,
                        'nombre' => $oldReserva->usua_nombre,
                        'apellido' => '',
                        'email' => $oldReserva->usua_email,
                        'telefono' => '',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    // Insert into the new PostgreSQL database
                    $reservaId = DB::connection('pgsql')->table('reservas')->insertGetId($newReserva);

                    $newEstado = [
                        'reserva_id' => $reservaId,
                        'estado_id' => 2
                    ];

                    // Insert the new Pago record
                    DB::connection('pgsql')->table('reserva_estado')->insert($newEstado);

                    $newPago = [
                        'reserva_id' => $reservaId,
                        'status' => '',
                        'numero_comprobante' => '',
                        'total' => $oldReserva->res_importe_total,
                        'moneda_id' => 1,
                        'metodo_pago_id' => $oldReserva->res_forma_pago,
                        'created_at' => Carbon::parse($oldReserva->res_fecha_fin),
                        'tipo_persona_descuento' => 0,
                        'metodo_pago_descuento' => 0,
                        'updated_at' => now(),
                    ];

                    // Insert the new Pago record
                    DB::connection('pgsql')->table('pagos')->insert($newPago);
                    
                    $count += 1;

                    $this->info('Migrated reserva: ' . $newReserva["nombre"] . " Nro: " . $count);
                } catch (\Throwable $th) {
                    //throw $th;
                    $this->error($th->getMessage());
                    exit;
                }
                
            }
        });
    }
}
