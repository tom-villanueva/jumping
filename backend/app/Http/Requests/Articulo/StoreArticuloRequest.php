<?php

namespace App\Http\Requests\Articulo;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticuloRequest extends FormRequest
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
            'codigo' => 'required|unique:articulo,codigo',
            'descripcion' => 'required|unique:articulo,descripcion',
            'observacion' => 'nullable',
            'tipo_articulo_id' => 'required|exists:tipo_articulos,id',
            'talle_id' => 'required|exists:talle,id',
            'marca_id' => 'required|exists:marca,id',
            'modelo_id' => 'required|exists:modelo,id',
            'nro_serie' => 'nullable|unique:articulo,nro_serie',
            'disponible' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}