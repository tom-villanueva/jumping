<?php

namespace App\Http\Requests\Equipo;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipoRequest extends FormRequest
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
        $equipo_id = $this->route('id');
        return [
            'descripcion' => 'required|unique:equipo,descripcion,'.$equipo_id,
            'precio' => 'nullable|integer|min:0',
            'disponible' => 'required|boolean',
            'tipo_articulo_ids' => 'nullable|array',
            'tipo_articulo_ids.*.tipo_articulo_id' => 'exists:tipo_articulos,id',
        ];
    }

    public function messages()
    {
        return [
            'tipo_articulo_ids.*.tipo_articulo_id.exists' => 'El tipo artículo en posición :position no existe en la BD.'
        ];
    }
}