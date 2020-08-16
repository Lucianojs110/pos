<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table = 'detalle_ingreso';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $filable = [

        'idingreso',
        'idarticulo',
        'cantidad',
        'precio_compra',
        'precio_venta',
       
    ];
    protected $guarded = [
      
    ]; 
}
