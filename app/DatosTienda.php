<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosTienda extends Model
{
    protected $table = 'datos_tienda';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $filable = [
        'nombre',
        'nombre_fantasia',
        'cuit',
        'direccion',
        'responsable',
        'logo',
      
    ];
    protected $guarded = [

      
    ];
}
