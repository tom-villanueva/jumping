<?php

namespace App\Http\Requests\EquipoPrecio;

use App\Models\EquipoPrecio;
use App\Rules\AfterLastEquipoPrecio;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEquipoPrecioRequest extends FormRequest
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
            'equipo_id' => 'required|exists:equipo,id',
            'precio' => 'required|integer|min:0',
            'fecha_desde' => [
                'required',
                'date_format:Y-m-d',
                new AfterLastEquipoPrecio()
            ] 
            // 'required|date_format:Y-m-d|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}