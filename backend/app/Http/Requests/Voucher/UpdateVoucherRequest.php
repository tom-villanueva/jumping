<?php

namespace App\Http\Requests\Voucher;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherRequest extends FormRequest
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
            'descripcion' => 'nullable|string',
            'fecha_expiracion' => 'required|date_format:Y-m-d|after_or_equal:today',
            'dias' => 'required|integer|min:0',
            'reserva_id' => 'nullable|exists:reservas,id',
            'cliente_id' => 'required|exists:clientes,id'
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}