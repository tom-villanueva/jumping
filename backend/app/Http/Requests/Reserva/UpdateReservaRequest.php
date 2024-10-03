<?php

namespace App\Http\Requests\Reserva;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReservaRequest extends FormRequest
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
            // 'fecha_desde' => 'required|date_format:Y-m-d',
            // 'fecha_hasta' => 'required|date_format:Y-m-d|after_or_equal:fecha_desde',
            // 'fecha_prueba' => 'nullable|date_format:Y-m-d|after_or_equal:fecha_desde',
            'comentario' => 'nullable|string|max:255',
            // 'estado_id' => 'required|exists:estados,id',
            'user_id' => 'nullable|exists:users,id',
            'nombre' => 'nullable',
            'apellido' => 'nullable',
            'email' => 'nullable',
            'telefono' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}