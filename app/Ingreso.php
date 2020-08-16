<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingreso';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $filable = [

        'id_proveedor',
        'tipo_comprobante',
        'num_comprobante',
        'tipo_comprobante',
        'fecha',
        'impuesto',
        'estado',
    ];
    protected $guarded = [

      
    ]; 
}
