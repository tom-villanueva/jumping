<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
        $cliente_id = $this->route('id');
        return [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => [
                'required',   // Email is required
                'string',     // Should be a string
                'email',      // Ensure valid email format
                'max:255',    // Limit the email length
                'unique:clientes,email,'.$cliente_id  // Ensure the email is unique in the users table
            ],
            'telefono' => 'nullable',
            'tipo_persona_id' => 'nullable|exists:tipo_persona,id',
            'user_id' => 'nullable|exists:users,id',
            'fecha_nacimiento' => 'nullable|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}