<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingreso;
use App\Detalle_Ingreso;
use App\Http\Requests\IngresoFormRequest;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;


class IngresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ingresos = DB::table('ingreso as i')
            ->join('persona as p','i.idproveedor', '=','p.idpersona')
            ->join('detalle_ingreso as di','i.id', '=','di.idingreso')
            ->select('i.id', 'i.fecha', 'p.nombre',
            'i.tipo_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado',
            DB::raw('sum(di.cantidad*di.precio_compra)as total'));

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
           $ingreso->idproveedor = request('idproveedor');
           $ingreso->tipo_comprobante = request('tipo_comprobante');
           $ingreso->num_comprobante = request('num_comprobante');
           $date = Carbon::now('America/Argentina/Buenos_Aires');
           $date = $date->format('d-m-Y');
           $ingreso->fecha = $date->toDateString(); 
           $ingreso->impuesto = '18';
           $ingreso->estado = 'A';
           $ingreso->save();


           $idarticulo = request('idarticulo');
           $cantidad = request('cantidad');
           $precio_compra = request('precio_compra');
           $precio_venta = request('precio_venta');

           $cont = 0;
           
           while($cont < count($idarticulo)){
              $detalle = new DetalleIngreso();
              $detalle->idingreso = $ingreso->id;
              $detalle->idarticulo = $idarticulo[$count];
              $detalle->cantidad = $cantidad[$count];
              $detalle->precio_compra = $precio_compra[$count];
              $detalle->precio_venta = $precio_venta[$count];
              $detalle->save();
              $count=$count+1;

           }
           DB::conmit();

       }catch(\Exeption $e)
       {
            DB::rollback();
       }
       
    
        return redirect('ingreso');
    }

    public function show($id, Request $request)
    {
        $ingreso = DB::table('ingreso as i')
        ->join('persona as p','i.idproveedor', '=','p.idpersona')
        ->join('detalle_ingreso as di','i.id', '=','di.idingreso')
        ->select('i.id', 'i.fecha', 'p.nombre',
        'i.tipo_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado',
        DB::raw('sum(di.cantidad*di.precio_compra)as total'))
        ->where('i.id','=',$id)
        ->first();
        
        $detalles = DB::table('detalle_ingreso as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra', 'd.precio_venta')
            ->where('d.ingreso','=', $id)
            ->get();


        return view ('ingreso.show', ["ingreso"=>$ingreso, "detalles"=>$detalles]);
      
    }


  
}
