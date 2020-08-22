<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaFormRequest;
use DataTables;
use Session;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categoria = Categoria::all();

            return DataTables::of($categoria)
          
                ->addColumn('action', 'categoria.actions')
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('categoria.index');
    }

    public function edit($id,  Request $request)
    {
        
        return view ('categoria.edit', ['categoria' => Categoria::findOrFail($id)]);
    }

    public function update(CategoriaFormRequest $request, $id)
    {
       $categoria= Categoria::findOrFail($id);
       $categoria->nombre = request('nombre');
       $categoria->descripcion = request('descripcion');
       $categoria->update();
       Session::flash('success', 'Categoria Actualizada con exito');
       return redirect('categoria');
    }

    public function store (CategoriaFormRequest $request)
    {
        $categoria =  new Categoria();

        $categoria->nombre = request('nombre');
        $categoria->descripcion = request('descripcion');
        $categoria->condicion = 1;
       
        $categoria->save();
        Session::flash('success', 'Categoria Creada con exito');
        return redirect('categoria');
    }

    public function destroy($id)
    {
        $categoria = Categoria::FindOrFail($id);
        $categoria->delete();
        return redirect('/categoria');
    }

    public function create(Request $request)
    {
        
        return view ('categoria.create');
    }

    public function show($id, Request $request)
    {
     
        return view ('categoria.show', ['categoria' => Categoria::findOrFail($id)]);
      
    }

}
