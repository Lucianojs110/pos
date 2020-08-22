<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingreso;
use App\DetalleIngreso;
use App\Articulo;
use App\Http\Requests\IngresoFormRequest;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;
use Session;


class IngresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ingresos = DB::table('ingreso')
            ->join('persona','ingreso.id_proveedor', '=','persona.id')
            ->join('detalle_ingreso','ingreso.id', '=','detalle_ingreso.idingreso')
            ->select('ingreso.id', 'ingreso.fecha', 'persona.nombre',
            'ingreso.tipo_comprobante', 'ingreso.num_comprobante', 'ingreso.impuesto', 'ingreso.estado',
            DB::raw('sum(detalle_ingreso.cantidad*precio_compra)as total'))
            ->groupBy('ingreso.id', 'ingreso.fecha', 'persona.nombre',
            'ingreso.tipo_comprobante', 'ingreso.num_comprobante', 'ingreso.impuesto', 'ingreso.estado');
            return DataTables::of($ingresos)
          
                ->addColumn('action', 'ingreso.actions')
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('ingreso.index');
    }

    public function create(Request $request)
    {
        $personas=DB::table('Persona')->where('tipo_persona','=','proveedor')->get();
        $articulos=DB::table('articulo as art')
        ->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'), 'art.id')
        ->where('art.estado','=','activo')
        ->get();
        
        return view ('ingreso.create', ["personas"=>$personas, "articulos"=>$articulos]);
    }

    public function store (IngresoFormRequest $request)
    {
       try{
           DB::beginTransaction();

           $ingreso=  new Ingreso();
           $ingreso->id_proveedor = request('idproveedor');
           $ingreso->tipo_comprobante = request('tipo_comprobante');
           $ingreso->num_comprobante = request('num_comprobante');
           $date = Carbon::now('America/Argentina/Buenos_Aires');
           
           $ingreso->fecha = $date->toDateString(); 
           $ingreso->impuesto = '21';
           $ingreso->estado = 'Activo';
           $ingreso->save();


           $idarticulo = request('idarticulo');
           $cantidad = request('cantidad');
           $precio_compra = request('precio_compra');
           $precio_venta = request('precio_venta');

           $cont = 0;
           
           while($cont < count($idarticulo)){
              $detalle = new DetalleIngreso();
              $detalle->idingreso = $ingreso->id;
              $detalle->idarticulo = $idarticulo[$cont];
              $detalle->cantidad = $cantidad[$cont];
              $detalle->precio_compra = $precio_compra[$cont];
              $detalle->precio_venta = $precio_venta[$cont];
              $detalle->save();
              
              $id = $idarticulo[$cont];
              $articulo= Articulo::findOrFail($id);
              $articulo->precio_venta = $precio_venta[$cont];
              $articulo->update();
              
              $cont=$cont+1;

           }
           DB::commit();

       }catch(\Exeption $e)
       {
            DB::rollback();
       }
       
       Session::flash('success', 'Ingreso Agregado');
        return redirect('ingreso');
    }

    public function show($id, Request $request)
    {
        $ingreso = DB::table('ingreso as i')
        ->join('persona as p','i.id_proveedor', '=','p.id')
        ->join('detalle_ingreso as di','i.id', '=','di.idingreso')
        ->select('i.id', 'i.fecha', 'p.nombre',
        'i.tipo_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado',
        DB::raw('sum(di.cantidad*di.precio_compra)as total'))
        ->where('i.id','=',$id)
        ->groupBy('i.id', 'i.fecha', 'p.nombre',
        'i.tipo_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado')
        ->first();
        
        $detalles = DB::table('detalle_ingreso as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.id')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra', 'd.precio_venta')
            ->where('d.idingreso','=', $id)
            ->get();


        return view ('ingreso.show', ["ingreso"=>$ingreso, "detalles"=>$detalles]);
      
    }
    public function destroy($id)
    {
        $ingreso= Ingreso::FindOrFail($id);
        $ingreso->estado='Cancelado';
        $ingreso->update();
        Session::flash('success', 'Ingreso Cancelado');
        return redirect('/ingreso');
    }

  
}
