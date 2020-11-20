<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaFormRequest extends FormRequest
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
            'nombre' =>  'required|max:100',
            'num_documento' =>  'required|max:11',
            'direccion' =>  'max:60',
            'telefono' =>  'max:20',
            'email' =>  'max:50',
        ];
    }
    public function messages()
    {
        return [
            'num_documento.required' => 'El campo numero de documento es obligatorio.',
          
        ];
    }
}
