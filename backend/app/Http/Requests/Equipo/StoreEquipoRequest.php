<?php

namespace App\Http\Requests\Equipo;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEquipoRequest extends FormRequest
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
            'descripcion' => 'required|unique:equipo,descripcion',
            'precio' => 'required|integer|min:0',
            'disponible' => 'required|boolean',
            'tipo_articulo_ids' => 'nullable|array',
            'tipo_articulo_ids.*.tipo_articulo_id' => 'exists:tipo_articulos,id',
            'descuentos_ids' => 'nullable|array',
            'descuentos_ids.*.descuento_id' => 'exists:descuentos,id',
            'descuentos_ids.*.fecha_desde' => 'date_format:Y-m-d|after_or_equal:today',
            'descuentos_ids.*.fecha_hasta' => 'date_format:Y-m-d|after_or_equal:descuentos_ids.*.fecha_desde',
        ];
    }

    public function messages()
    {
        return [
            'tipo_articulo_ids.*.tipo_articulo_id.exists' => 'El tipo artículo en posición :position no existe en la BD.'
        ];
    }
}