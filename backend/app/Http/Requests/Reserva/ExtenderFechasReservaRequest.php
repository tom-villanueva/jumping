<?php

namespace App\Http\Requests\Reserva;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ExtenderFechasReservaRequest extends FormRequest
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
            'fecha_desde' => 'required|date_format:Y-m-d',
            'fecha_hasta' => 'required|date_format:Y-m-d|after_or_equal:fecha_desde',
            'fecha_prueba' => 'nullable|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}