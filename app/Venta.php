<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'venta';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $filable = [
        'id_cliente',
        'id_usuario',
        'tipo_comprobante',
        'num_comprobante',
        'fecha',
        'impuesto',
        'total',
        'estado'
    ];
    protected $guarded = [

      
    ];

}
