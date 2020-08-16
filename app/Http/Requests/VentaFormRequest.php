<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaFormRequest extends FormRequest
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
            'id_cliente' =>  'required',
            'tipo_comprobante' =>  'required|max:20',
            'num_comprobante' =>  'required|max:30',
            'id_articulo' =>  'required',
            'precio_venta' =>  'required',
            'cantidad' =>  'required',
            'descuento' =>  'required',
            'total_venta' =>  'required',
        ];
    }
}
