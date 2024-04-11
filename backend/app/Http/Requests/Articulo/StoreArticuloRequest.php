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
            'observacion' => 'nullable',
            'tipo_articulo_talle_id' => 'required|exists:tipo_articulo_talle,id'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}