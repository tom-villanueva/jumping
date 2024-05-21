<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class NoOverlappingDiscounts implements DataAwareRule, ValidationRule
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
        $solapa = DB::table('equipo_descuento')
            ->where('equipo_id', $value)
            ->whereNull('deleted_at')
            ->where(function ($query) {
                $query->whereDate('fecha_desde', '>=', $this->data['fecha_desde'])
                      ->whereDate('fecha_desde', '<=', $this->data['fecha_hasta'])
                ->orWhere(function ($query) {
                    $query->whereDate('fecha_hasta', '>=', $this->data['fecha_desde'])
                          ->whereDate('fecha_hasta', '<=', $this->data['fecha_hasta']);
                })
                ->orWhere(function ($query) {
                    $query->whereDate('fecha_desde', '<=', $this->data['fecha_desde'])
                          ->whereDate('fecha_hasta', '>=', $this->data['fecha_hasta']);
                })
                ->orWhere(function ($query) {
                    $query->whereDate('fecha_desde', '>=', $this->data['fecha_desde'])
                          ->whereDate('fecha_hasta', '<=', $this->data['fecha_hasta']);
                });
            })
            ->exists();

        if($solapa) {
            $fail("Se solapa alguna fecha de descuento para este equipo.");
        }
    }
}
