@extends('layouts.app')

@section('content')
@if(count($errors) > 0 )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <ul class="p-0 m-0" style="list-style: none;">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card" style="background-color: #fff">
    <div class="card-header bg-info mb-3">
    <h3>Nueva Venta</h3>
     </div>
     <div class="container p-2 my-2">   
    <form action="/venta" method="POST" enctype="multipart/form-data">
    @csrf
    
    
    <div class="row">
        <div class="form-group col-md-6">
              <label for="nombre">Cliente</label>
              <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
              <option value="conFin" selected>Consumidor Final</option>
                @foreach($personas as $persona)
              <option value='{{$persona->id}}'>{{$persona->nombre}}</option> 
                @endforeach
              </select>
          </div>

            <div class="form-group col-md-3">
                <label>Tipo comprobante</label>
                  <select name="tipo_comprobante" class="form-control">
                    <option value="Factura A">Factura A</option>
                    <option value="Factura B">Factura B</option>
                    <option value="Factura C">Factura C</option>
                    </select>

            </div>
            <div class="form-group col-md-3">
                  <label>Número Comprobante</label>
                  <input type="text" disabled class="form-control" name="num_comprobante" value={{$numComp}}>
            </div>

         
        </div>
        </div>
        </div>
   
        <div class="card" style="background-color: #fff">
        <div class="container p-2 my-2"> 
        <div class="row">      
                   <div class="col col-lg-3">
                   <label for="nombre">Articulo</label>
                       <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
                            <option selected disabled>Elige un articulo</option>
                             @foreach($articulos as $articulo)
                            <option value="{{$articulo->id}}_{{$articulo->stock}}_{{$articulo->precio_venta}}">{{$articulo->articulo}}</option> 
                            @endforeach
                       </select>
                   </div>
                   <div class="col col-lg-2"> 
                        <label>Cantidad</label>
                        <input type="number" class="form-control" id="pcantidad" name="cantidad" placeholder="cantidad">
                  </div>
                  <div class="col col-lg-2"> 
                        <label>stock</label>
                        <input type="number" disabled class="form-control" id="pstock" name="pstock" placeholder="stock">
                  </div>
                  <div class="col col-lg-2"> 
                        <label>Precio venta</label>
                        <input type="number" class="form-control" id="pprecio_venta" name="pprecio_venta" placeholder="P. venta">
                  </div>
                  <div class="col col-lg-2"> 
                        <label>Descuento</label>
                        <input type="number" class="form-control" id="pdescuento" name="stock" placeholder="descuento">
                  </div>
                  <div class="col col-lg-1" style="margin-top:auto"> 
                  <button type="button" id="bt-add" class="btn btn-primary">Agregar</button>
                  </div>
        </div>    
        <br>       
         <div class="row">
         <div class="col col-lg-12">
         <table class="table table-hover" id="detalle">
           <thead class="thead-light">
             <tr>
             <th>Eliminar</th>
             <th>Articulo</th>
             <th>Cantidad</th>
             <th>P. venta</th>
             <th>Descuento</th>
             <th>Subtotal</th>
             </tr>
           </thead>
          <tbody>
    
          </tbody>
          <tfoot>
          <tr>
             <th><h4>TOTAL</h4></th>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th><h4 id="total">$0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
             </tr>
          </tfoot>
         </table>
         </div>
         </div>
      
      
  <div class="row" id="guardar">   
    <div class="form-group col-md-12" >
         <button type="submit" class="btn btn-primary">Registrar</button>
         <button type="reset" class="btn btn-danger">Cancelar</button>
         <a href="{{url('ingreso')}}" class="btn btn-secondary">Volver</a>
    </div>
</div>
</div>

</div>
   
    </form>
    <script>
    $.fn.selectpicker.Constructor.BootstrapVersion = '4';
    </script>
    @push('scripts')
    <script>
    
    
    $(document).ready(function(){
          $("#bt-add").click(function(){
            agregar();
            
          });

          $('#guardar').hide();
          $("#pidarticulo").change(mostrarValores);
    });

       total=0;
      var cont=0;
      subtotal=[];
     

      function mostrarValores()
      {
        datosArticulos= document.getElementById('pidarticulo').value.split('_');
        $("#pprecio_venta").val(datosArticulos[2]);
        $("#pstock").val(datosArticulos[1]);

      }

    function agregar(){

           datosArticulos= document.getElementById('pidarticulo').value.split('_');
          idarticulo= datosArticulos[0];
          articulo= $("#pidarticulo option:selected").text();
          cantidad= $("#pcantidad").val();
          descuento= $("#pdescuento").val();
          precio_venta= $("#pprecio_venta").val();
          stock= $("#pstock").val();
          
          if (idarticulo!="" && idarticulo!=0 && cantidad!="" && cantidad>0 && descuento!="" && precio_venta!="" )
          {
             if(stock>cantidad){
              subtotal[cont]=(cantidad*precio_venta-descuento);
              subtotal[cont] = +subtotal[cont].toFixed(2);
              total=total+subtotal[cont];
               total = +total.toFixed(2);
              var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input type="hidden" name="precio_venta[]" value="'+precio_venta+'">$'+precio_venta+'</td><td><input type="hidden" name="descuento[]" value="'+descuento+'">$'+descuento+'</td><td>$'+subtotal[cont]+'</td></tr>';
              cont++;
              limpiar();
              $("#total").html("$"+total);
              $("#total_venta").val(total);
              evaluar();
              $('#detalle').append(fila);
              }else
              {
                toastr.options.positionClass = "toast-bottom-right";
                toastr.warning("La cantidad a vender supera al stock actual")
              }
          }else
          {
            toastr.options.positionClass = "toast-bottom-right";
            toastr.warning("Ingrese un valor de cantidad y descuento")
          }

     }


      function limpiar(){
         
           $("#pdescuento").val("");
           $("#pcantidad").val("");
           $("#pprecio_venta").val("");
           $("#pstock").val("");

     }
     function evaluar(){
           if (total>0){
             $("#guardar").show();
           }
           else{
            $("#guardar").hide();
           }
     }
     function eliminar(index){
          total=total-subtotal[index];
          $("#total").html("$"+total);
          $("#fila" + index).remove();
          evaluar();

     }
     
    </script>
    @endpush
    @endsection