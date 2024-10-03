<?php

namespace App\Http\Requests\Reserva;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ExtenderReservaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'es_extension' => 'required|boolean',
            'fecha_desde' => 'required|date_format:Y-m-d|after_or_equal:today',
            'fecha_hasta' => 'required|date_format:Y-m-d|after_or_equal:fecha_desde',
            'fecha_prueba' => 'nullable|date_format:Y-m-d|after_or_equal:fecha_desde',
            'reserva_equipo_ids' => 'required|array',
            'reserva_equipo_ids.*.reserva_equipo_id' => 'exists:reserva_equipo,id',
            'comentario' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}