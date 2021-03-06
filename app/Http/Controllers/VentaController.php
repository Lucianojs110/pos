<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Articulo;
use App\DetalleVenta;
use App\DatosTienda;
use App\Http\Requests\VentaFormRequest;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;
use Session;
use Afip;


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
            'venta.total', 'venta.cae', 'venta.vtocae')
            ->groupBy('venta.id', 'venta.fecha', 'persona.nombre',
            'venta.tipo_comprobante', 'venta.num_comprobante', 'venta.impuesto', 'venta.estado',
            'venta.total', 'venta.cae', 'venta.vtocae')
            ->orderBy('venta.id', 'desc');
            
            return DataTables::of($venta)
          
                ->addColumn('action', 'venta.actions')
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('venta.index');
    }

    public function create(Request $request)
    {
       $personas=DB::table('persona')->where('tipo_persona','=','cliente')->get();

       $articulos=DB::table('articulo as art')
       ->join('detalle_ingreso as di','art.id','=', 'di.idarticulo')
       ->select(DB::raw('concat(art.codigo, " ",art.nombre) as articulo'), 'art.id', 'art.stock',
      'art.precio_venta')
       ->where('art.estado','=','activo')
       ->where('art.stock','>','0')
       ->groupBy('articulo', 'art.id', 'art.stock', 'art.precio_venta')
       ->get();

       $tienda=DB::table('datos_tienda')->where('id','=','1')->get();
       foreach ($tienda as $tienda1)
       {
        $cuit = $tienda1->cuit;
        $punto = $tienda1->punto_venta;
        $factura = $tienda1->responsable;
       }
      
       
        
       if ($factura == 11){
           $tipo_comprobante = "C";
           $afip = new Afip(array('CUIT' => $cuit));
           $last_voucher = $afip->ElectronicBilling->GetLastVoucher($punto,$factura);
           $numComp = $last_voucher + 1;
           $numComp = str_pad($numComp, 8, "0", STR_PAD_LEFT);
           $punto = str_pad($punto, 3, "0", STR_PAD_LEFT);

       }else{
        $tipo_comprobante = "B";
        $afip = new Afip(array('CUIT' => $cuit));
        $last_voucher = $afip->ElectronicBilling->GetLastVoucher($punto,$factura);
        $numComp = $last_voucher + 1;
        $numComp = str_pad($numComp, 8, "0", STR_PAD_LEFT);
        $punto = str_pad($punto, 3, "0", STR_PAD_LEFT);

       }

        return view ('venta.create', ["tipo_comprobante"=>$tipo_comprobante,"punto"=>$punto, "numComp"=>$numComp, "personas"=>$personas, "articulos"=>$articulos]);
    }

    
    public function lastVoucher(Request $request)
    {
        $tienda=DB::table('datos_tienda')->where('id','=','1')->get();
       foreach ($tienda as $tienda1)
       {
        $cuit = $tienda1->cuit;
        $punto = $tienda1->punto_venta;
       
       }
      
        if ($request->ajax()) {
            $factura = request('tipo');
        if ($factura == "FACTURA A"){
           
            $afip = new Afip(array('CUIT' => $cuit));
            $last_voucher = $afip->ElectronicBilling->GetLastVoucher($punto,1);
            $numComp = $last_voucher + 1;
            $numComp = str_pad($numComp, 8, "0", STR_PAD_LEFT);
            $punto = str_pad($punto, 3, "0", STR_PAD_LEFT);
            $last_voucher1 =  $numComp;
        }else
        {
            
            $afip = new Afip(array('CUIT' => $cuit));
            $last_voucher = $afip->ElectronicBilling->GetLastVoucher($punto,6);
            $numComp = $last_voucher + 1;
            $numComp = str_pad($numComp, 8, "0", STR_PAD_LEFT);
            $punto = str_pad($punto, 3, "0", STR_PAD_LEFT);
            
        }
        
    }
        return (["numComp"=>$numComp, "punto"=>$punto ]);
    }
    
    
    public function store (VentaFormRequest $request)
    {
       
        $tienda=DB::table('datos_tienda')->where('id','=','1')->get();
       foreach ($tienda as $tienda1)
       {
        $cuit = $tienda1->cuit;
        $punto = $tienda1->punto_venta;
        $factura = $tienda1->responsable;
       }
        
        
       $tipoComprobante = request('tipo_comprobante');

       if($tipoComprobante == "FACTURA C"){

        $afip = new Afip(array('CUIT' => $cuit));
        $last_voucher = $afip->ElectronicBilling->GetLastVoucher($punto ,11);
        $numComp = $last_voucher + 1;

        $ImpTotal = request('total_venta');
        $ImpNeto = $ImpTotal/1.21;
        $ImpNeto = number_format((float)$ImpNeto, 2, '.', '');
        $ImpIVA = $ImpTotal - $ImpNeto;
        $ImpIVA = number_format((float)$ImpIVA, 2, '.', '');
        
        $date = Carbon::now('America/Argentina/Buenos_Aires');
        $date2 = $date->format('Ymd');

        $data = array(
            'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
            'PtoVta' 	=> $punto,  // Punto de venta
            'CbteTipo' 	=> 11,  // Tipo de comprobante (ver tipos disponibles) 
            'Concepto' 	=> 1,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'DocTipo' 	=> 99, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'DocNro' 	=> 0,  // Número de documento del comprador (0 consumidor final)
            'CbteDesde' 	=> $numComp,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
            'CbteHasta' 	=> $numComp,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
            'CbteFch' 		=> intval($date2), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'ImpTotal' 	=> $ImpTotal, // Importe total del comprobante
            'ImpTotConc' 	=> 0,   // Importe neto no gravado
            'ImpNeto' 	=> $ImpTotal, // Importe neto gravado
            'ImpOpEx' 	=> 0,   // Importe exento de IVA
            'ImpIVA' 	=> 0,  //Importe total de IVA
            'ImpTrib' 	=> 0,   //Importe total de tributos
            'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
            'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)  
            
        );
        
        $res = $afip->ElectronicBilling->CreateVoucher($data);
        
        $cae=$res['CAE']; //CAE asignado el comprobante
        $vtocae = $res['CAEFchVto']; //Fecha de vencimiento del CAE (yyyy-mm-dd)


       }else if ($tipoComprobante == "FACTURA B"){

        $afip = new Afip(array('CUIT' => $cuit));
        $last_voucher = $afip->ElectronicBilling->GetLastVoucher($punto,6);
        $numComp = $last_voucher + 1;

        $ImpTotal = request('total_venta');
        $ImpNeto = $ImpTotal/1.21;
        $ImpNeto = number_format((float)$ImpNeto, 2, '.', '');
        $ImpIVA = $ImpTotal - $ImpNeto;
        $ImpIVA = number_format((float)$ImpIVA, 2, '.', '');
        
        $date = Carbon::now('America/Argentina/Buenos_Aires');
        $date2 = $date->format('Ymd');
        

        $data = array(
            'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
            'PtoVta' 	=> $punto,  // Punto de venta
            'CbteTipo' 	=> 6,  // Tipo de comprobante (ver tipos disponibles) 
            'Concepto' 	=> 1,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'DocTipo' 	=> 99, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'DocNro' 	=> 0,  // Número de documento del comprador (0 consumidor final)
            'CbteDesde' 	=> $numComp,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
            'CbteHasta' 	=> $numComp,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
            'CbteFch' 		=> intval($date2), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'ImpTotal' 	=> $ImpTotal, // Importe total del comprobante
            'ImpTotConc' 	=> 0,   // Importe neto no gravado
            'ImpNeto' 	=> $ImpNeto, // Importe neto gravado
            'ImpOpEx' 	=> 0,   // Importe exento de IVA
            'ImpIVA' 	=> $ImpIVA,  //Importe total de IVA
            'ImpTrib' 	=> 0,   //Importe total de tributos
            'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
            'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)  
            'Iva' 		=> array( // (Opcional) Alícuotas asociadas al comprobante
                array(
                    'Id' 		=> 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles) 
                    'BaseImp' 	=> $ImpNeto, // Base imponible
                    'Importe' 	=> $ImpIVA // Importe 
                )
            ), 
        );
        
        $res = $afip->ElectronicBilling->CreateVoucher($data);
        
        $cae=$res['CAE']; //CAE asignado el comprobante
        $vtocae = $res['CAEFchVto']; //Fecha de vencimiento del CAE (yyyy-mm-dd)


       }else if ($tipoComprobante == "FACTURA A"){
       
    
        $afip = new Afip(array('CUIT' => $cuit));
        $last_voucher = $afip->ElectronicBilling->GetLastVoucher($punto,1);
        $numComp = $last_voucher + 1;

        $ImpTotal = request('total_venta');
        $ImpNeto = $ImpTotal/1.21;
        $ImpNeto = number_format((float)$ImpNeto, 2, '.', '');
        $ImpIVA = $ImpTotal - $ImpNeto;
        $ImpIVA = number_format((float)$ImpIVA, 2, '.', '');
        
        $date = Carbon::now('America/Argentina/Buenos_Aires');
        $date2 = $date->format('Ymd');
        $clientCuit = request('cuit');
        
        $data = array(
            'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
            'PtoVta' 	=> intval($punto),  // Punto de venta
            'CbteTipo' 	=> 1,  // Tipo de comprobante (ver tipos disponibles) 
            'Concepto' 	=> 1,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'DocTipo' 	=> 80, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'DocNro' 	=> intval($clientCuit),  // Número de documento del comprador (0 consumidor final)
            'CbteDesde' 	=> $numComp,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
            'CbteHasta' 	=> $numComp,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
            'CbteFch' 		=> intval($date2), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'ImpTotal' 	=> $ImpTotal, // Importe total del comprobante
            'ImpTotConc' 	=> 0,   // Importe neto no gravado
            'ImpNeto' 	=> $ImpNeto, // Importe neto gravado
            'ImpOpEx' 	=> 0,   // Importe exento de IVA
            'ImpIVA' 	=> $ImpIVA,  //Importe total de IVA
            'ImpTrib' 	=> 0,   //Importe total de tributos
            'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
            'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)  
            'Iva' 		=> array( // (Opcional) Alícuotas asociadas al comprobante
                array(
                    'Id' 		=> 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles) 
                    'BaseImp' 	=> $ImpNeto, // Base imponible
                    'Importe' 	=> $ImpIVA // Importe 
                )
            ), 
        );
        
        $res = $afip->ElectronicBilling->CreateVoucher($data);
        
        $cae=$res['CAE']; //CAE asignado el comprobante
        $vtocae = $res['CAEFchVto']; //Fecha de vencimiento del CAE (yyyy-mm-dd)
    
    
        }

       
       
       
       
        try{
           DB::beginTransaction();

           $venta=  new Venta();
           $venta->idcliente = request('idcliente2');
           $venta->idusuario = auth()->id();
           $venta->tipo_comprobante = request('tipo_comprobante');
           $venta->num_comprobante = str_pad($numComp, 8, "0", STR_PAD_LEFT); 
           $venta->cae = $cae;
           $venta->vtocae = $vtocae;
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
       return redirect('/venta');
    }

    public function show($id, Request $request)
    {
        $tiendas=DB::table('datos_tienda')->where('id','=','1')->get();
       
        $venta = DB::table('venta as v')
        ->join('persona as p','v.idcliente', '=','p.id')
        ->join('detalle_venta as dv','v.id', '=','dv.idventa')
        ->select('v.id', 'v.fecha', 'p.nombre', 'p.tipo', 'p.num_documento', 'p.direccion', 'p.telefono',
        'v.tipo_comprobante', 'v.num_comprobante', 'v.impuesto', 
         'v.total', 'v.cae', 'v.vtocae')
        ->where('v.id','=',$id)
        ->first();
        
        $detalles = DB::table('detalle_venta as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.id')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.descuento', 'd.precio_venta')
            ->where('d.idventa','=', $id)
            ->get();


        return view ('venta.show', ["tiendas"=>$tiendas, "venta"=>$venta, "detalles"=>$detalles]);
      
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
