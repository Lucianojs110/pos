<?php

namespace App\Http\Controllers;

use App\DatosTienda;
use Illuminate\Http\Request;
use App\Http\Requests\DatosTiendaFormRequest;
use Illuminate\Support\Facades\DB;
use Validator;

class DatosTiendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function update( Request $request)
    {
       $id=1;
       $tienda= DatosTienda::findOrFail($id);
       $tienda->nombre = request('nombre');
       $tienda->nombre_fantasia = request('fantasia');
       $tienda->cuit = request('cuit');
       $tienda->direccion = request('direccion');
       $tienda->responsable = request('iva');
    
       $tienda ->update();
     
       return redirect('/');
    }

    public function updatelogo( Request $request)
    {
       $validation = Validator::make($request->all(),[
       'select_file' =>  'required|mimes:jpeg,bmp,png,jpg']);
       if($validation->passes()){
        $id=1;
        $tienda= DatosTienda::findOrFail($id);
        $image = $request->file('select_file');
        $image->move(public_path().'/imagenes', $image->getClientOriginalName());
        $tienda->logo = $image->getClientOriginalName();
        $tienda ->update();
        return response()->json([
            'message' => 'Logo Actualizado correctamente'
      ]);
        return redirect('/');
       }else
       {
          return response()->json([
                'message' => 'ingrese un formato valido'
          ]);
       }
       
       
       
    }
}
