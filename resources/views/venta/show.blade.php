@extends('layouts.app')

@section('content')


    <div class="container p-3 my-3 border" style="background-color: #fff">
    <h2>Detalle de Venta</h2>
   
    @csrf
    
    <div class="container p-3 my-3 border" style="background-color: #fff">
    <div class="row">
           <div class="form-group col-md-2">
                  <label>Nº Comprobante</label>
                  <p>{{$venta->num_comprobante}}</p>
            </div>
         
         <div class="form-group col-md-2">
              <label for="nombre">Fecha</label>
             <p>{{$newDate = date("d-m-Y", strtotime($venta->fecha))}}</p>
            
          </div>
          
           <div class="form-group col-md-2">
              <label for="nombre">Cliente</label>
             <p>{{$venta->nombre}}</p>
          </div>

            <div class="form-group col-md-2">
                <label>Tipo comprobante</label>
                <p>{{$venta->tipo_comprobante}}</p>

            </div>
          
            <div class="form-group col-md-2">
                  <label>Iva</label>
                  <p>%{{$venta->impuesto}}</p>
            </div>  
        </div>
        </div>
   
        <div class="container p-3 my-3 border" style="background-color: #fff">    
         <div class="row">
         <div class="col col-lg-12">
         <table class="table table-hover" id="detalle">
           <thead class="thead-dark">
             <tr>
             <th>Articulos</th>
             <th>Cantidad</th>
             <th>P. venta</th>
             <th>Decuento</th>
             <th>Subtotal</th>
             </tr>
           </thead>
          <tbody>
            @foreach($detalles as $detalle)
            <tr>
             <th>{{$detalle->articulo}}</th>
             <th>{{$detalle->cantidad}}</th>
             <th>${{$detalle->precio_venta}}</th>
             <th>${{$detalle->descuento}}</th>
             <th>${{$detalle->cantidad*$detalle->precio_venta-$detalle->descuento}}</th>
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
      <div class="row" id="guardar">   
    <div class="form-group col-md-12" >
         
         <button type="button" class="btn btn-success">imprimir</button>
         <a href="{{url('venta')}}" class="btn btn-secondary">Volver</a>
    </div>
 
</div>
    
   
   
  
    @endsection