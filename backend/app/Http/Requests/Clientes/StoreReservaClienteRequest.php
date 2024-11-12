<?php

namespace App\Http\Requests\Clientes;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservaClienteRequest extends FormRequest
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
            'fecha_desde' => 
                [
                    'required',
                    'date_format:Y-m-d',
                    'after_or_equal:today',
                    function ($attribute, $value, $fail) {
                        $month = date('m', strtotime($value));
                        if ($month < 6 || $month > 9) {
                            $fail('La fecha de inicio debe estar en los meses de junio a septiembre.');
                        }
                    },
                ],
            'fecha_hasta' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:fecha_desde',
                function ($attribute, $value, $fail) {
                    $month = date('m', strtotime($value));
                    if ($month < 6 || $month > 9) {
                        $fail('La fecha de finalización debe estar en los meses de junio a septiembre.');
                    }
                },
            ],
            'fecha_prueba' => 'nullable|date_format:Y-m-d',
            'user_id' => 'nullable|exists:users,id',
            'nombre' => 'nullable',
            'apellido' => 'required',
            'email' => 'required',
            'telefono' => 'nullable',
            'equipos' => 'required|array',
            'traslados' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}