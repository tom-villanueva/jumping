<?php

namespace App\Http\Requests\Empleado;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoRequest extends FormRequest
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
        $empleado_id = $this->route('id');
        return [
            'name' => [
                'required',   // Name is required
                'string',     // Ensure it is a string
                'max:255'     // Limit the name to a reasonable length
            ],
            'email' => [
                'required',   // Email is required
                'string',     // Should be a string
                'email',      // Ensure valid email format
                'max:255',    // Limit the email length
                'unique:empleados,email,'.$empleado_id  // Ensure the email is unique in the users table
            ],
            'password' => [
                'nullable',   // Password is not required
                'string',     // Ensure it's a string
                'min:8',      // Minimum password length for security
                'confirmed',  // Make sure the password is confirmed
                'regex:/[A-Z]/',       // At least one uppercase letter
                'regex:/[@$!%*?&]/',   // At least one special character
            ],
            'isAdmin' => [
                'required',   // isAdmin must be provided
                'boolean'     // Ensure it's a boolean value
            ],
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}