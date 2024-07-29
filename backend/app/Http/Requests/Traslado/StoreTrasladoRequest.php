<?php

namespace App\Http\Requests\Traslado;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTrasladoRequest extends FormRequest
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
            'direccion' => 'required',
            'fecha_desde' => 'required|date_format:Y-m-d|after_or_equal:today',
            'fecha_hasta' => 'required|date_format:Y-m-d|after_or_equal:fecha_desde',
            'reserva_id' => 'required|exists:reservas,id'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}