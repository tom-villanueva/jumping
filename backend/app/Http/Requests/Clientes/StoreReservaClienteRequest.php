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
            'nombre' => 'required|string|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'apellido' => 'required|string|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email:rfc,dns|max:255',
            'telefono' => 'nullable|string|max:15|regex:/^\+?[0-9]{7,15}$/',
            'crear_user' => 'nullable|boolean',
            'equipos' => 'required|array',
            'equipos.*.equipo_id' => 'required|exists:equipo,id',
            'equipos.*.nombre' => 'nullable|string|max:255',
            'equipos.*.apellido' => 'nullable|string|max:255',
            'traslados' => 'required|array',
            'traslados.*.direccion' => 'required|string|max:255',
            'traslados.*.fecha_desde' => 'required|date_format:Y-m-d',
            'traslados.*.fecha_hasta' => 'required|date_format:Y-m-d|after_or_equal:traslados.*.fecha_desde'
        ];
    }

    public function messages()
    {
        return [
            'fecha_desde.after_or_equal' => 'La fecha de inicio no puede ser anterior a hoy.',
            'fecha_hasta.after_or_equal' => 'La fecha de finalización debe ser posterior o igual a la fecha de inicio.',
            'telefono.regex' => 'El formato del número de teléfono no es válido.',
            'email.email' => 'Debe proporcionar un email válido.',
            // Add more custom messages as needed.
        ];
    }
}