<?php

namespace App\Models;

use App\Core\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\QueryBuilder\AllowedFilter;

class Reserva extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'fecha_prueba',
        'fecha_desde',
        'fecha_hasta',
        'comentario',
        'estado_id',
        'user_id',
        'nombre',
        'apellido',
        'email',
        'telefono'
    ];

    /**
     * Relaciones
     */
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
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
            AllowedFilter::exact('estado_id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::beginsWithStrict('apellido'),
            AllowedFilter::beginsWithStrict('email'),
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
            'user',
            'estado',
            'traslados',
            'equipos'
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

        foreach ($this->equipos as $reservaEquipo) {
            // Get the associated precios and descuentos for the reservation equipo
            $totalPrice += $this->calculateReservaEquipoPrice($reservaEquipo);
        }

        return $totalPrice;
    }

    /**
     * Calculate the total price for a single ReservaEquipo.
     *
     * @param ReservaEquipo $reservaEquipo
     * @return float
     */
    private function calculateReservaEquipoPrice(ReservaEquipo $reservaEquipo)
    {
        $price = 0;

        $startDate = Carbon::parse($this->fecha_desde);
        $endDate = Carbon::parse($this->fecha_hasta);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        // Fetch the applicable prices within the reservation date range
        foreach ($reservaEquipo->precios as $reservaEquipoPrecio) {
            $equipoPrecio = $reservaEquipoPrecio->equipo_precio()->withTrashed()->first();

            if ($equipoPrecio) {
                // Compare the date ranges to determine how many days apply to each price
                $precioStartDate = Carbon::parse($equipoPrecio->fecha_desde);
                $precioEndDate = Carbon::parse($equipoPrecio->fecha_hasta);

                // Get the overlapping days between reservation and price validity period
                $daysForThisPrice = $this->getOverlappingDays($startDate, $endDate, $precioStartDate, $precioEndDate);

                // Multiply the price per day by the number of applicable days
                $price += $equipoPrecio->precio * $daysForThisPrice;
            }
        }

        // Now apply any discounts
        foreach ($reservaEquipo->descuentos as $reservaEquipoDescuento) {
            $equipoDescuento = $reservaEquipoDescuento->equipo_descuento()->withTrashed()->first();

            if ($equipoDescuento) {
                // Compare the date ranges for the discount
                $descuentoStartDate = Carbon::parse($equipoDescuento->fecha_desde);
                $descuentoEndDate = Carbon::parse($equipoDescuento->fecha_hasta);

                // Get the overlapping days between reservation and discount validity period
                $daysForThisDiscount = $this->getOverlappingDays($startDate, $endDate, $descuentoStartDate, $descuentoEndDate);

                // Apply the discount for the applicable days
                $discountAmount = $equipoDescuento->descuento * $daysForThisDiscount;
                $price -= $discountAmount;
            }
        }

        return $price;
    }

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
        $overlapStart = $startDate1->max($startDate2);
        $overlapEnd = $endDate1->min($endDate2);

        if ($overlapStart->lte($overlapEnd)) {
            return $overlapStart->diffInDays($overlapEnd) + 1;
        }

        return 0;
    }
}
