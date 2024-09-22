<?php

namespace App\Http\Requests\Talle;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTalleRequest extends FormRequest
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
        $talle_id = $this->route('id');
        return [
            'descripcion' => 'required|unique:talle,descripcion,'.$talle_id,
            // 'tipo_articulo_ids' => 'nullable|array',
            // 'tipo_articulo_ids.*.tipo_articulo_id' => 'exists:tipo_articulos,id',
            // 'tipo_articulo_ids.*.stock' => 'integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            // 'tipo_articulo_ids.*.tipo_articulo_id.exists' => 'El tipo artículo en posición :position no existe en la BD.' 
        ];
    }
}