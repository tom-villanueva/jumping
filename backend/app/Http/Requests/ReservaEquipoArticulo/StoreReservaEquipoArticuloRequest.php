<?php

namespace App\Http\Requests\ReservaEquipoArticulo;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservaEquipoArticuloRequest extends FormRequest
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
            'articulo_id' => 'required|exists:articulo,id',
            'devuelto' => 'required'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}