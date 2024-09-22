<?php

namespace App\Http\Requests\Inventario;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInventarioRequest extends FormRequest
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
            'tipo_articulo_id' => 'required|exists:tipo_articulos,id',
            'talle_id' => 'required|exists:talle,id',
            'marca_id' => 'required|exists:marca,id',
            'modelo_id' => 'required|exists:modelo,id',
            'stock' => 'required|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}