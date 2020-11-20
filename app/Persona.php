<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $filable = [
        'tipo_persona',
        'nombre',
        'tipo',
        'num_documento',
        'direccion',
        'telefono',
        'email'
    ];
    protected $guarded = [

      
    ];
}
