<?php

namespace App\Http\Requests\TipoArticulo;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTipoArticuloRequest extends FormRequest
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
        $tipo_articulo_id = $this->route('id');
        return [
            'descripcion' => 'required|unique:tipo_articulos,descripcion,'.$tipo_articulo_id,
            'talle_ids' => 'nullable|array',
            'talle_ids.*.talle_id' => 'integer|exists:talle,id',
            'talle_ids.*.stock' => 'integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            'talle_ids.*.talle_id.exists' => 'El talle :position debe existir en la BD' 
        ];
    }
}