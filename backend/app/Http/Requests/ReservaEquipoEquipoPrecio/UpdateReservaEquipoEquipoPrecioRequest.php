<?php

namespace App\Http\Requests\ReservaEquipoEquipoPrecio;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReservaEquipoEquipoPrecioRequest extends FormRequest
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
            'reserva_equipo_id' => 'required|exists:reserva_equipo,id',
            'equipo_precio_id' => 'required|exists:equipo_precio,id',
            'equipo_descuento_id' => 'nullable|exists:equipo_descuento,id'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}