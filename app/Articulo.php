<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $filable = [
        'idcategoria',
        'codigo',
        'nombre',
        'stock',
        'descripcion',
        'condicion',
        'imagen',
        'estado'
    ];
    protected $guarded = [

      
    ];

}
