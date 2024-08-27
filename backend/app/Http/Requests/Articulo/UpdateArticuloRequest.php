<?php

namespace App\Http\Requests\Articulo;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticuloRequest extends FormRequest
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
        $articulo_id = $this->route('id');
        return [
            'codigo' => 'required|unique:articulo,codigo,'.$articulo_id,
            'descripcion' => 'required|unique:articulo,descripcion,'.$articulo_id,
            'observacion' => 'nullable',
            // 'tipo_articulo_talle_id' => 'required|exists:tipo_articulo_talle,id',
            'tipo_articulo_id' => 'required|exists:tipo_articulos,id',
            'talle_id' => 'required|exists:talle,id',
            'nro_serie' => 'nullable|unique:articulo,nro_serie,'.$articulo_id,
            'disponible' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}