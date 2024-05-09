<?php

namespace App\Http\Requests\Equipo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateEquipoThumbnailRequest extends FormRequest
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
        // $equipo_id = $this->route('id');
        return [
            'thumbnail' => [
                'required',
                File::image()
                    ->max('1mb')
            ]
        ];
    }

    public function messages()
    {
        return [];
    }
}