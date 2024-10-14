<?php

namespace App\Http\Requests\TrasladoPrecio;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTrasladoPrecioRequest extends FormRequest
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
            'precio' => 'required|integer|min:0',
            'fecha_desde' => 'required|date_format:Y-m-d|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}