<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Articulo;
use App\DetalleVenta;
use App\Http\Requests\VentaFormRequest;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;
use Session;

class VentaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $venta = DB::table('venta')
            ->join('persona','venta.idcliente', '=','persona.id')
            ->join('detalle_venta','venta.id', '=','detalle_venta.idventa')
            ->select('venta.id', 'venta.fecha', 'persona.nombre',
            'venta.tipo_comprobante', 'venta.num_comprobante', 'venta.impuesto', 'venta.estado',
            'venta.total')
            ->groupBy('venta.id', 'venta.fecha', 'persona.nombre',
            'venta.tipo_comprobante', 'venta.num_comprobante', 'venta.impuesto', 'venta.estado',
            'venta.total');
            return DataTables::of($venta)
          
                ->addColumn('action', 'venta.actions')
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('venta.index');
    }

    public function create(Request $request)
    {
       $personas=DB::table('Persona')->where('tipo_persona','=','cliente')->get();
       
       $articulos=DB::table('articulo as art')
       ->join('detalle_ingreso as di','art.id','=', 'di.idarticulo')
       ->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'), 'art.id', 'art.stock',
      'art.precio_venta')
       ->where('art.estado','=','activo')
       ->where('art.stock','>','0')
       ->groupBy('articulo', 'art.id', 'art.stock')
       ->get();
   
        return view ('venta.create', ["personas"=>$personas, "articulos"=>$articulos]);
    }

    public function store (VentaFormRequest $request)
    {
       try{
           DB::beginTransaction();

           $venta=  new Venta();
           $venta->idcliente = request('idcliente');
           $venta->idusuario = auth()->id();
           $venta->tipo_comprobante = request('tipo_comprobante');
           $venta->num_comprobante = '1';
           $date = Carbon::now('America/Argentina/Buenos_Aires');
           $venta->fecha = $date->toDateString(); 
           $venta->impuesto = '21';
           $venta->total = request('total_venta');
           
           $venta->estado = 'Activo';
           $venta->save();


           $idarticulo = request('idarticulo');
           $cantidad = request('cantidad');
           $descuento = request('descuento');
           $precio_venta = request('precio_venta');

           $cont = 0;
           
           while($cont < count($idarticulo)){
              $detalle = new DetalleVenta();
              $detalle->idventa = $venta->id;
              $detalle->idarticulo = $idarticulo[$cont];
              $detalle->cantidad = $cantidad[$cont];
              $detalle->descuento = $descuento[$cont];
              $detalle->precio_venta = $precio_venta[$cont];
              $detalle->save();
              $cont=$cont+1;

           }
           DB::commit();

       }catch(\Exeption $e)
       {
            DB::rollback();
       }
       
       Session::flash('success', 'Venta Creada');
    return redirect('venta');
    }

    public function show($id, Request $request)
    {
        $venta = DB::table('venta as v')
        ->join('persona as p','v.idcliente', '=','p.id')
        ->join('detalle_venta as dv','v.id', '=','dv.idventa')
        ->select('v.id', 'v.fecha', 'p.nombre',
        'v.tipo_comprobante', 'v.num_comprobante', 'v.impuesto', 
         'v.total')
        ->where('v.id','=',$id)
        ->first();
        
        $detalles = DB::table('detalle_venta as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.id')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.descuento', 'd.precio_venta')
            ->where('d.idventa','=', $id)
            ->get();


        return view ('venta.show', ["venta"=>$venta, "detalles"=>$detalles]);
      
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
