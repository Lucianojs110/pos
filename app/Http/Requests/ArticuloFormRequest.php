<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloFormRequest extends FormRequest
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
            'idcategoria' =>  'required',
            'nombre' =>  'required|max:50',
            'descripcion' =>  'max:250',
            'stock' =>  'required|numeric',
            'precio_venta' =>  'required|numeric',
            'imagen' => 'mimes:jpeg,bmp,png,jpg'
        ];

       
    }

public function messages()
{
    return [
        'idcategoria.required' => 'Selecciona una categoría.',
      
    ];
}
}
