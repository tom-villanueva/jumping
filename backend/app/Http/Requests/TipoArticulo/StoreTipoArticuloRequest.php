<?php

namespace App\Http\Requests\TipoArticulo;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTipoArticuloRequest extends FormRequest
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
            'descripcion' => 'required|unique:tipo_articulos,descripcion',
            'talle_ids' => 'nullable|array',
            'talle_ids.*.talle_id' => 'integer|exists:talle,id',
            'marca_ids' => 'nullable|array',
            'marca_ids.*.marca_id' => 'integer|exists:marca,id',
            // 'talle_ids.*.stock' => 'integer|min:0',
            'equipo_ids' => 'nullable|array',
            'equipo_ids.*.equipo_id' => 'integer|exists:equipo,id',
        ];
    }

    public function messages()
    {
        return [
            'talle_ids.*.talle_id.exists' => 'El talle en posición :position no existe en la BD.',
            'equipo_ids.*.equipo_id.exists' => 'El equipo en posición :position no existe en la BD.',
            'marca_ids.*.marca_id.exists' => 'El marca en posición :position no existe en la BD.'
        ];
    }
}