<?php

namespace App\Rules;

use App\Models\Reserva;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class BeforeReservaFechaHasta implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];
 
    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;
 
        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $reserva = Reserva::find($this->data["reserva_id"]);

        if(Carbon::parse($value)->gt(Carbon::parse($reserva->fecha_hasta))) {
            $fail("La fecha de fin debe ser inferior a la fecha de fin de la reserva.");
        }
    }
}