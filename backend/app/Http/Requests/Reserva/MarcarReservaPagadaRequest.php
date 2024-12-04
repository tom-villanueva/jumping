<?php

namespace App\Http\Requests\Reserva;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MarcarReservaPagadaRequest extends FormRequest
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
            'metodo_pago_id' => 'required|exists:metodo_pago,id',
            'moneda_id' => 'required|exists:monedas,id',
            // 'tipo_persona_id' => 'nullable|exists:tipo_persona,id',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}