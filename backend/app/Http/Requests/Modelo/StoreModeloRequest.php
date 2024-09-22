<?php

namespace App\Http\Requests\Modelo;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreModeloRequest extends FormRequest
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
            'descripcion' => 'required|unique:modelo,descripcion',
            'marca_id' => 'required|exists:marca,id',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}