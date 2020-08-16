<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoFormRequest extends FormRequest
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
            'idproveedor' =>  'required',
            'tipo_comprobante' =>  'required|max:20',
            'num_comprobante' =>  'required|max:20',
            'idarticulo' =>  'required',
            'cantidad' =>  'required',
            'precio_compra' =>  'required',
            'precio_venta' =>  'required',
        ];
    }
}
