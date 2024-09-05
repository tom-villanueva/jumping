<?php

namespace App\Http\Requests\Equipo;

use App\Rules\NoOverlappingDiscountsUpdate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipoDescuentoRequest extends FormRequest
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
            'id' => 'required|exists:equipo_descuento,id',
            'equipo_id' => ['required', 'exists:equipo,id', new NoOverlappingDiscountsUpdate()],
            'descuento_id' => 'exists:descuentos,id',
            'fecha_desde' => 'date_format:Y-m-d|after_or_equal:today',
            'fecha_hasta' => 'date_format:Y-m-d|after_or_equal:fecha_desde',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}