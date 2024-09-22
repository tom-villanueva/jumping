<?php

namespace App\Http\Requests\Marca;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMarcaRequest extends FormRequest
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
        $marca_id = $this->route('id');
        return [
            'descripcion' => 'required|unique:marca,descripcion,'.$marca_id,
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}