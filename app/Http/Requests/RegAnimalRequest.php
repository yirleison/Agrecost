<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegAnimalRequest extends FormRequest
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
        'Marcado'=> 'required|max:5',
        'Nombre'=> 'required|max:20',
        'Fecha'=> 'required',
        'Sexo'=> 'required|max:10',
        'Peso'=> 'required|max:20',
        'Estado'=> 'required',
        'Raza'=> 'required|max:20',
        ];
    }
}
