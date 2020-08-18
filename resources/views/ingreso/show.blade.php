@extends('layouts.app')

@section('content')


    <div class="container p-3 my-3 border" style="background-color: #fff">
    <h2>Detalle de Ingreso</h2>
   
    @csrf
    
    <div class="container p-3 my-3 border" style="background-color: #fff">
    <div class="row">
        
         <div class="form-group col-md-3">
              <label for="nombre">Fecha</label>
             <p>{{$ingreso->fecha}}</p>
          </div>
          
           <div class="form-group col-md-3">
              <label for="nombre">Proveedor</label>
             <p>{{$ingreso->nombre}}</p>
          </div>

            <div class="form-group col-md-3">
                <label>Tipo comprobante</label>
                <p>{{$ingreso->tipo_comprobante}}</p>

            </div>
            <div class="form-group col-md-3">
                  <label>Número Comprobante</label>
                  <p>{{$ingreso->num_comprobante}}</p>
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
             <th>P. compra</th>
             <th>P. venta</th>
             <th>Subtotal</th>
             </tr>
           </thead>
          <tbody>
            @foreach($detalles as $detalle)
            <tr>
             <th>{{$detalle->articulo}}</th>
             <th>{{$detalle->cantidad}}</th>
             <th>${{$detalle->precio_compra}}</th>
             <th>${{$detalle->precio_venta}}</th>
             <th>${{$detalle->cantidad*$detalle->precio_compra}}</th>
             </tr>
            @endforeach
          </tbody>
          <tfoot>
          <tr>
             <th><h4>TOTAL</h4></th>
             <th></th>
             <th></th>
             <th></th>
             <th><h4>${{$ingreso->total}}</h4></th>
             </tr>
          </tfoot>
         </table>
         </div>
         </div>
      </div>
      <div class="row" id="guardar">   
    <div class="form-group col-md-12" >
         
         <button type="button" class="btn btn-success">imprimir</button>
         <a href="{{url('ingreso')}}" class="btn btn-secondary">Volver</a>
    </div>
 
</div>
    
   
   
  
    @endsection