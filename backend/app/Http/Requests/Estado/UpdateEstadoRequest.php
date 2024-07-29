<?php

namespace App\Http\Requests\Estado;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEstadoRequest extends FormRequest
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
        $estado_id = $this->route('id');
        return [
            'descripcion' => 'required|unique:estados,descripcion,'.$estado_id,
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}