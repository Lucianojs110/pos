<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Detalle_Venta;
use App\Http\Requests\VentaFormRequest;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;

class VentaController extends Controller
{
    
    public function create(Request $request)
    {
        
        return view ('venta.create');
    }
   
   
   
    public function store (PersonaFormRequest $request)
    {
        $personas =  new Persona();
        $personas->tipo_persona = 'cliente';
        $personas->nombre = request('nombre');
        $personas->tipo_documento = request('tipo_documento');
        $personas->num_documento = request('num_documento');
        $personas->direccion = request('direccion');
        $personas->telefono = request('telefono');
        $personas->email = request('email');
             
        $personas->save();

        return redirect('cliente');
    }
}
