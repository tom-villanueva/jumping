<?php

namespace App\Models;

use App\Core\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Period\Period;
use Spatie\QueryBuilder\AllowedFilter;

class Reserva extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'reservas';

    protected $appends = [
        'estado_actual',
        'precio_total'
    ];

    protected $fillable = [
        'fecha_prueba',
        'fecha_desde',
        'fecha_hasta',
        'comentario',
        'cliente_id',
        // 'user_id',
        // 'nombre',
        // 'apellido',
        // 'email',
        // 'telefono'
    ];

    /**
     * Relaciones
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function estados()
    {
        return $this->hasMany(ReservaEstado::class, 'reserva_id');
    }

    public function voucher()
    {
        return $this->hasOne(Voucher::class, 'reserva_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'reserva_id');
    }

    public function getEstadoActualAttribute()
    {
        return $this->estados()
            ->with('estado')
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function traslados()
    {
        return $this->hasMany(Traslado::class, 'reserva_id');
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'reserva_equipo', 'reserva_id', 'equipo_id')
            ->withPivot(['id', 'altura', 'peso', 'nombre', 'apellido', 'num_calzado'])
            ->wherePivotNull('deleted_at')
            ->withTimestamps();
    }

    public function getPrecioTotalAttribute()
    {
        return $this->calculateTotalPrice();
    }

    public function equipos_reservados()
    {
        return $this->hasMany(ReservaEquipo::class, 'reserva_id')
            ->with('equipo')
            ->with('descuentos');
    }

    /**
     * Scopes de fechas
     */

    // fecha desde
    public function scopeFechaDesdeBefore($query, $date)
    {
        return $query->where('fecha_desde', '<=', Carbon::parse($date));
    }

    public function scopeFechaDesdeAfter($query, $date)
    {
        return $query->where('fecha_desde', '>=', Carbon::parse($date));
    }

    public function scopeFechaDesdeBetween($query, $date1, $date2)
    {
        return $query->whereBetween('fecha_desde', [$date1, $date2]);
    }

    // fecha hasta
    public function scopeFechaHastaBefore($query, $date)
    {
        return $query->where('fecha_hasta', '<=', Carbon::parse($date));
    }

    public function scopeFechaHastaAfter($query, $date)
    {
        return $query->where('fecha_hasta', '>=', Carbon::parse($date));
    }

    public function scopeFechaHastaBetween($query, $date1, $date2)
    {
        return $query->whereBetween('fecha_hasta', [$date1, $date2]);
    }

    // Entre fecha desde y fecha hasta
    public function scopeFechasBetween($query, $date1, $date2)
    {
        return $query
            ->whereDate('fecha_desde', '>=', $date1)
            ->whereDate('fecha_hasta', '<=', $date2);
    }

    /**
     * query builder options
     */
    public function allowedFilters()
    {
        return [
            // AllowedFilter::callback('estado_id', function (Builder $query, $value) {
            //     $query->whereHas('estados', function ($query) use ($value) {
            //         $query->latest('created_at') // Ensure we're using the latest estado
            //             ->take(1) // Limit to the latest estado record
            //             ->where('estado_id', $value); // Filter by the passed estado_id
            //     });
            // }),
            AllowedFilter::callback('estado_id', function (Builder $query, $value) {
                $query->whereHas('estados', function (Builder $query) use ($value) {
                    $query->where('estado_id', $value)
                        ->whereRaw('created_at = (SELECT MAX(created_at) FROM reserva_estado WHERE reserva_id = reservas.id)');
                });
            }),

            AllowedFilter::callback('articulo_codigo', function (Builder $query, $value) {
                $query->whereHas('equipos_reservados.articulos.articulo', function ($query) use ($value) {
                    $query->where('articulo.codigo', $value)
                        ->where('reserva_equipo_articulo.devuelto', false);
                });
            }),

            AllowedFilter::exact('cliente_id'),
            AllowedFilter::beginsWithStrict('cliente.nombre'),
            AllowedFilter::beginsWithStrict('cliente.apellido'),
            AllowedFilter::beginsWithStrict('cliente.email'),
            'telefono',
            AllowedFilter::scope('fecha_desde_before'),
            AllowedFilter::scope('fecha_desde_after'),
            AllowedFilter::scope('fecha_desde_between'),
            AllowedFilter::scope('fecha_hasta_before'),
            AllowedFilter::scope('fecha_hasta_after'),
            AllowedFilter::scope('fecha_hasta_between'),
            AllowedFilter::scope('fechas_between'),
        ];
    }

    public function allowedSorts()
    {
        return [
            'fecha_desde',
            'fecha_hasta'
        ];
    }

    public function allowedIncludes()
    {
        return [
            'cliente',
            'cliente.tipo_persona.descuento',
            'traslados',
            'equipos',
            'pagos',
            'pagos.metodo_pago',
            'pagos.tipo_persona',
            'voucher',
            'voucher.equipo_voucher'
        ];
    }

    /**
     * Métodos
     */
    /**
     * Calculate the total price of the reservation.
     *
     * @return float
     */
    public function calculateTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->equipos_reservados as $reservaEquipo) {
            // Get the associated precios and descuentos for the reservation equipo
            $totalPrice += $this->calculateReservaEquipoPrice($reservaEquipo);
        }

        foreach ($this->traslados as $traslado) {
            $totalPrice += $this->calculateReservaTrasladoPrice($traslado);
        }

        return round($totalPrice, 2);
    }

    private function calculateReservaEquipoPrice(ReservaEquipo $reservaEquipo)
    {
        $totalPrice = 0;

        $startDate = Carbon::parse($this->fecha_desde);
        $endDate = Carbon::parse($this->fecha_hasta);

        $descuento = $reservaEquipo->descuentos()->first();
        // $array = [];
        // Fetch the applicable prices within the reservation date range
        foreach ($reservaEquipo->precios as $reservaEquipoPrecio) {
            // $equipoPrecio = $reservaEquipoPrecio->equipo_precio()->withTrashed()->first();

            // if ($equipoPrecio) {
            // Compare the date ranges to determine how many days apply to each price
            $precioStartDate = Carbon::parse($reservaEquipoPrecio->fecha_desde);
            $precioEndDate = Carbon::parse($reservaEquipoPrecio->fecha_hasta);

            // Get the overlapping days between reservation and price validity period
            $daysForThisPrice = $this->getOverlappingDays($startDate, $endDate, $precioStartDate, $precioEndDate);
            // $array[] = $daysForThisPrice;
            // Calculate the total price for this period
            $priceForThisPeriod = 0;

            if (!empty($descuento)) {
                $priceForThisPeriod = ($reservaEquipoPrecio->precio - ($reservaEquipoPrecio->precio * ($descuento->descuento / 100))) * $daysForThisPrice;
            } else {
                $priceForThisPeriod = $reservaEquipoPrecio->precio * $daysForThisPrice;
            }

            // Add the discounted price to the total price
            $totalPrice += $priceForThisPeriod;
        }

        return $totalPrice;
    }

    private function calculateReservaTrasladoPrice(Traslado $traslado)
    {
        $startDate = Carbon::parse($this->fecha_desde);
        $endDate = Carbon::parse($this->fecha_hasta);

        $precioStartDate = Carbon::parse($traslado->fecha_desde);
        $precioEndDate = Carbon::parse($traslado->fecha_hasta);

        $daysForThisPrice = $this->getOverlappingDays($startDate, $endDate, $precioStartDate, $precioEndDate);

        $priceForThisPeriod = 0;

        $priceForThisPeriod = $traslado->precio * $daysForThisPrice;

        return $priceForThisPeriod;
    }

    /**
     * Apply overlapping discounts for a given price period.
     *
     * @param ReservaEquipo $reservaEquipo
     * @param EquipoPrecio $equipoPrecio
     * @param int $daysForThisPrice
     * @param Carbon $precioStartDate
     * @param Carbon $precioEndDate
     * @param Carbon $reservaStartDate
     * @param Carbon $reservaEndDate
     * @return float The total discount amount for the given price period
     */
    // private function applyOverlappingDiscountsForPrice(
    //     ReservaEquipo $reservaEquipo,
    //     ReservaEquipoPrecio $reservaEquipoPrecio,
    //     Carbon $precioStartDate,
    //     Carbon $precioEndDate,
    //     Carbon $reservaStartDate,
    //     Carbon $reservaEndDate,
    // ) {
    //     $totalDiscount = 0;
    //     // $array = [];
    //     foreach ($reservaEquipo->descuentos as $reservaEquipoDescuento) {
    //         // $equipoDescuento = $reservaEquipoDescuento->equipo_descuento()->withTrashed()->first();

    //         // if ($equipoDescuento) {
    //         // Compare the date ranges for the discount
    //         $descuentoStartDate = Carbon::parse($reservaEquipoDescuento->fecha_desde);
    //         $descuentoEndDate = Carbon::parse($reservaEquipoDescuento->fecha_hasta);

    //         $periodDescuento = Period::make($descuentoStartDate, $descuentoEndDate);
    //         $periodPrecio = Period::make($precioStartDate, $precioEndDate);

    //         if ($periodDescuento->overlapsWith($periodPrecio)) {
    //             $periodReserva = Period::make($reservaStartDate, $reservaEndDate);
    //             $periodWithReserva = $periodDescuento->overlap($periodPrecio, $periodReserva);
    //             $daysForThisDiscount = $periodWithReserva->length();

    //             if ($daysForThisDiscount > 0) {
    //                 // Calculate the discount for the applicable overlapping days
    //                 $discountPerDay = $reservaEquipoPrecio->precio * ($reservaEquipoDescuento->descuento / 100);
    //                 $totalDiscount += $discountPerDay * $daysForThisDiscount;
    //                 // $array[$periodWithReserva->asString()] = $discountPerDay * $daysForThisDiscount;
    //             }
    //         }
    //         // }
    //     }

    //     return $totalDiscount;
    // }

    /**
     * Calculate the number of overlapping days between two date ranges.
     *
     * @param Carbon $startDate1
     * @param Carbon $endDate1
     * @param Carbon $startDate2
     * @param Carbon $endDate2
     * @return int
     */
    private function getOverlappingDays(Carbon $startDate1, Carbon $endDate1, Carbon $startDate2, Carbon $endDate2)
    {
        $period1 = Period::make($startDate1, $endDate1);
        $period2 = Period::make($startDate2, $endDate2);

        $resultingPeriod = $period1->overlap($period2);

        return $resultingPeriod->length();
    }
}
