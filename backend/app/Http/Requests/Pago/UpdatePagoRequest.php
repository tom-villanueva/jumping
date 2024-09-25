<?php

namespace App\Http\Requests\Pago;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePagoRequest extends FormRequest
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
            'total' => 'required|integer|min:0',
            'status' => 'required|string',
            'numero_comprobante' => 'required|string',
            'metodo_pago_id' => 'required|exists:metodo_pago,id',
            'moneda_id' => 'required|exists:monedas,id',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}