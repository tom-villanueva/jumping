<?php

namespace App\Http\Requests\Equipo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipoDescuentosRequest extends FormRequest
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
            'descuentos_ids' => 'required|array',
            'descuentos_ids.*.descuento_id' => 'exists:descuentos,id',
            'descuentos_ids.*.fecha_desde' => 'date_format:Y-m-d|after_or_equal:today',
            'descuentos_ids.*.fecha_hasta' => 'date_format:Y-m-d|after_or_equal:descuentos_ids.*.fecha_desde',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}