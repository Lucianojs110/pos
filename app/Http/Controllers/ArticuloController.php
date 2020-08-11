<?php

namespace App\Http\Controllers;
use App\Articulo;
use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\ArticuloFormRequest;
use Illuminate\Support\Facades\DB;
use DataTables;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
          
            $articulo = DB::table('articulo')
            ->join('categoria', 'articulo.idcategoria', '=', 'categoria.id')
            ->where('articulo.estado','=','activo')
            ->select('articulo.id', 'articulo.nombre as nombrearticulo', 'articulo.codigo',
            'articulo.descripcion', 'articulo.stock', 
            'categoria.nombre', 'articulo.imagen');


            return DataTables::of($articulo)
                 
                ->addColumn('imagen', function($articulo){
                    if (empty($articulo->imagen)){
                        return '';
                    }
                    return '<img src="imagenes/articulos/'.$articulo->imagen.'" height="40px" width="40px">';
                    
                })
                ->addColumn('action', 'articulo.actions')
                ->rawColumns(['imagen', 'action'])
                ->make(true);

        }

        return view('articulo.index');
    }

    public function edit($id,  Request $request)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view ('articulo.edit', ['articulo' => $articulo, 'categoria' => $categoria]);
    }

    public function update(ArticuloFormRequest $request, $id)
    {
       $articulo= Articulo::findOrFail($id);
       $articulo->idcategoria = request('idcategoria');
       $articulo->codigo = request('codigo');
       $articulo->nombre = request('nombre');
       $articulo->stock = request('stock');
       $articulo->descripcion = request('descripcion');
       $articulo->estado = 'activo';
       $articulo->update();

       return redirect('articulo');
    }

    public function store (ArticuloFormRequest $request)
    {
        $articulo =  new Articulo();

        $articulo->idcategoria = request('idcategoria');
        $articulo->codigo = request('codigo');
        $articulo->nombre = request('nombre');
        $articulo->stock = request('stock');
        $articulo->descripcion = request('descripcion');
        $articulo->estado = 'activo';
        if ($request->hasFile('imagen')){
            $file = $request->imagen;
            $file->move(public_path().'/imagenes/articulos', $file->getClientOriginalName());
            $articulo->imagen = $file->getClientOriginalName();
        }
       
        $articulo->save();

        return redirect('articulo');
    }

    public function destroy($id)
    {
        $articulo = Articulo::FindOrFail($id);
        $articulo->estado='Inactivo';
        $articulo->update();
        return redirect('/articulo');
    }

    public function create(Request $request)
    {
        $categoria = Categoria::all();
        return view ('articulo.create', ['categoria'=>$categoria]);
    }

    public function show($id, Request $request)
    {
     
        return view ('articulo.show', ['articulo' => Articulo::findOrFail($id)]);
      
    }
}
