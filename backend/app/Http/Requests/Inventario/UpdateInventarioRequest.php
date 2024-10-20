<?php

namespace App\Http\Requests\Inventario;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInventarioRequest extends FormRequest
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
            'tipo_articulo_id' => 'nullable|exists:tipo_articulos,id',
            'talle_id' => 'nullable|exists:talle,id',
            'marca_id' => 'nullable|exists:marca,id',
            'modelo_id' => 'nullable|exists:modelo,id',
            'stock' => 'required|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}