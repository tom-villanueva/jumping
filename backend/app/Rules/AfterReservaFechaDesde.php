<?php

namespace App\Rules;

use App\Models\Reserva;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class AfterReservaFechaDesde implements DataAwareRule, ValidationRule
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

        if(Carbon::parse($value)->lt(Carbon::parse($reserva->fecha_desde))) {
            $fail("La fecha de inicio debe ser superior a la fecha de inicio de la reserva.");
        }
    }
}