<?php

namespace App\Http\Requests\ReservaEquipo;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReservaEquipoRequest extends FormRequest
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
            'altura' => 'nullable|integer',
            'peso' => 'nullable|integer',
            'num_calzado' => 'nullable|integer',
            'nombre' => 'nullable|string',
            'apellido' => 'nullable|string',
            'reserva_id' => 'required|exists:reservas,id',
            'equipo_id' => 'required|exists:equipo,id'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}