<?php

namespace App\Http\Requests\Descuento;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDescuentoRequest extends FormRequest
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
            'valor' => 'required|unique:descuentos,valor|numeric|min:0',
            'descripcion' => 'nullable|string',
            'tipo_descuento' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}