<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_venta';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $filable = [
        'id_venta',
        'id_articulo',
        'cantidad',
        'precio_venta',
        'descuento',
      
    ];
    protected $guarded = [

      
    ];
}
