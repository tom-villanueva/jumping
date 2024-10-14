<?php

namespace App\Http\Requests\TrasladoPrecio;

use App\Rules\AfterLastTrasladoPrecio;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTrasladoPrecioRequest extends FormRequest
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
            'fecha_desde' => [
                'required',
                'date_format:Y-m-d',
                new AfterLastTrasladoPrecio()
            ] 
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}