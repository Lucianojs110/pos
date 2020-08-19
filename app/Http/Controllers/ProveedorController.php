<?php

namespace App\Http\Controllers;

use App\Proveedor;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Requests\PersonaFormRequest;
use Illuminate\Support\Facades\DB;
use DataTables;
use Session;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $persona = DB::table('persona')
            ->where('persona.tipo_persona','=','proveedor')
            ->select('persona.id', 'persona.nombre', 'persona.tipo_documento',
            'persona.num_documento', 'persona.direccion', 'persona.email', 'persona.telefono');

            return DataTables::of($persona)
          
                ->addColumn('action', 'proveedor.actions')
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('proveedor.index');
    }

    public function create(Request $request)
    {
        
        return view ('proveedor.create');
    }

    public function store (PersonaFormRequest $request)
    {
        $personas =  new Persona();
        $personas->tipo_persona = 'proveedor';
        $personas->nombre = request('nombre');
        $personas->tipo_documento = request('tipo_documento');
        $personas->num_documento = request('num_documento');
        $personas->direccion = request('direccion');
        $personas->telefono = request('telefono');
        $personas->email = request('email');
             
        $personas->save();

        return redirect('proveedor');
    }

    public function edit($id,  Request $request)
    {
        
        return view ('proveedor.edit', ['persona' => Persona::findOrFail($id)]);
    }

    public function update(PersonaFormRequest $request, $id)
    {
       $personas= Persona::findOrFail($id);
       $personas->tipo_persona = 'proveedor';
        $personas->nombre = request('nombre');
        $personas->tipo_documento = request('tipo_documento');
        $personas->num_documento = request('num_documento');
        $personas->direccion = request('direccion');
        $personas->telefono = request('telefono');
        $personas->email = request('email');
             
        $personas->update();

       return redirect('proveedor');
    }

  

    public function destroy($id)
    {
        $persona = Persona::FindOrFail($id);
        $persona->tipo_persona='Inactivo';
        $persona->update();
        return redirect('/proveedor');
    }

 

    public function show($id, Request $request)
    {
     
        return view ('proveedor.show', ['persona' => Persona::findOrFail($id)]);
      
    }
}
