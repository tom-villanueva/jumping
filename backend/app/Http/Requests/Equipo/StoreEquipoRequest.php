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
            'precio' => 'nullable|integer|min:0',
            'disponible' => 'required|boolean',
            'tipo_articulo_ids' => 'nullable|array',
            'tipo_articulo_ids.*.tipo_articulo_id' => 'exists:tipo_articulos,id',
            'tipo_equipo_id' => 'nullable|exists:tipo_equipos,id'
        ];
    }

    public function messages()
    {
        return [
            'tipo_articulo_ids.*.tipo_articulo_id.exists' => 'El tipo artículo en posición :position no existe en la BD.'
        ];
    }
}