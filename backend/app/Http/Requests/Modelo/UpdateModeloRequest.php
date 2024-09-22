<?php

namespace App\Http\Requests\Modelo;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateModeloRequest extends FormRequest
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
        $modelo_id = $this->route('id');
        return [
            'descripcion' => 'required|unique:modelo,descripcion,'.$modelo_id,
            'marca_id' => 'required|exists:marca,id',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}