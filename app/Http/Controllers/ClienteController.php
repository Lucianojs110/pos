<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Requests\PersonaFormRequest;
use Illuminate\Support\Facades\DB;
use DataTables;
use Session;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $personas = DB::table('persona')
            ->where('persona.tipo_persona','=','cliente')
            ->select('persona.id', 'persona.nombre', 'persona.tipo_documento',
            'persona.num_documento', 'persona.direccion', 'persona.email', 'persona.telefono');

            return DataTables::of($personas)
          
                ->addColumn('action', 'cliente.actions')
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('cliente.index');
    }

    public function create(Request $request)
    {
        
        return view ('cliente.create');
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

    public function edit($id,  Request $request)
    {
        
        return view ('cliente.edit', ['persona' => Persona::findOrFail($id)]);
    }

    public function update(PersonaFormRequest $request, $id)
    {
       $personas= Persona::findOrFail($id);
       $personas->tipo_persona = 'cliente';
        $personas->nombre = request('nombre');
        $personas->tipo_documento = request('tipo_documento');
        $personas->num_documento = request('num_documento');
        $personas->direccion = request('direccion');
        $personas->telefono = request('telefono');
        $personas->email = request('email');
             
        $personas->update();

       return redirect('cliente');
    }

  

    public function destroy($id)
    {
        $persona = Persona::FindOrFail($id);
        $persona->tipo_persona='Inactivo';
        $persona->update();
        return redirect('/cliente');
    }

 

    public function show($id, Request $request)
    {
     
        return view ('cliente.show', ['persona' => Persona::findOrFail($id)]);
      
    }

}
