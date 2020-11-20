@extends('layouts.app')

@section('content')


    <div class="container p-3 my-3 border" style="background-color: #fff">
    
   
    @csrf

    <div class="print">
        
    <div class="container">
    @foreach($tiendas as $tienda)
    <div class="row border">
    <div class="col-sm-2 ">
    <img src="{{asset('imagenes/'.$tienda->logo)}}" alt="{{$tienda->logo}}" class="card-img-top" height="100%" width="100%">
      </div>
        
        <div class="col-sm-4 pt-3" >
        
                    <h2> {{{$tienda->nombre_fantasia}}}</h2>
                    Razon Social: {{{$tienda->nombre}}}<br>
                    Direccion: {{{$tienda->direccion}}}<br>
                    
            
                    @if($tienda->responsable == 11)
                    Iva: Monotributo 
                    @else
                  Iva: Responsable Inscripto 
                    @endif
                   
               @endforeach 
        
        </div>
        <div class="col-sm-3 pt-3">
        <h2>{{$venta->tipo_comprobante}}</h2>
        </div>
        <div class="col-sm-3 pt-4">
        
        <h4>Nº: {{str_pad($venta->num_comprobante, 8, "0", STR_PAD_LEFT)}}</h4>
          Fecha: {{$newDate = date("d-m-Y", strtotime($venta->fecha))}}<BR>
          Cuit: {{{$tienda->cuit}}}<br>
        </div>
    </div>
    <br>
    <div class="row border" >
        <div class="col-sm-6 p-2 ">
        Razon Social: {{$venta->nombre}} <br>
        Cuit: {{$venta->num_documento}} <br>
        Cond. IVA: {{$venta->tipo}} <br>
        </div>
        <div class="col-sm-6 p-2 ">
        
        Domicilio: {{$venta->direccion}} <br>
        Telefono: {{$venta->telefono}} <br>
        Cond. Venta: CONTADO
        </div>
    </div>
    </div>

    <div class="container p-3 my-3 border">
    <div class="row">
        <div class="col-sm-12">
        <div class="table-responsive">
        <table class="table" id="detalle">
           <thead >
             <tr>
             <th>Articulo</th>
             <th>Cant.</th>
             <th>P. Unit.</th>
             <th>Desc.</th>
             <th>Subtotal</th>
             </tr>
           </thead>
          <tbody>
            @foreach($detalles as $detalle)
            <tr>
             <th>{{$detalle->articulo}}</th>
             <th>{{$detalle->cantidad}}</th>
             <th>{{$detalle->precio_venta}}</th>
             <th>{{$detalle->descuento}}</th>
             <th>{{$detalle->cantidad*$detalle->precio_venta-$detalle->descuento}}</th>
             </tr>
            @endforeach
          </tbody>
          <tfoot>
          <tr>
             <th><h4>TOTAL</h4></th>
             <th></th>
             <th></th>
             <th></th>
             <th><h4>${{$venta->total}}</h4></th>
             </tr>
          </tfoot>
         </table>
         </div>
        </div>
        
    </div>
    </div>
    <div class="container p-3 my-3 border" style="background-color: #fff">    
    <div class="row">
        <div class="col-sm-8">
        
        </div>
        <div class="col-sm-4">
        CAE: {{$venta->cae}} <br>
        Vto. CAE: {{$venta->vtocae}} 
        </div>
    </div>
    </div>



      </div>
      <div class="row" id="guardar">   
    <div class="form-group col-md-12" >
         
        
         <button class="btn btn-success" id="print">Imprimir</button>
         <a href="{{url('venta')}}" class="btn btn-secondary">Volver</a>
    </div>
    </div>
</div>

<script>
  $(document).ready(function(){
          $("#print").click(function(){
            console.log("hola");
          });
          
          
    });
</script>

    @endsection

   
 


    
    