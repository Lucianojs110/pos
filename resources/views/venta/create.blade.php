@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
        @if ($errors->any())
          <div class='alert alert-danger'>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
          </ul>
        </div>
        @endif
      </div>
</div>

    <div class="container p-3 my-3 border" style="background-color: #fff">
    <h2>Nueva Venta </h2>
    <form action="/venta" method="POST" enctype="multipart/form-data">
    @csrf
    
    
    <div class="row">
         
   

        <div class="form-group col-md-6">
              <label for="nombre">Cliente</label>
              <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
              <option selected disabled>Elige un cliente</option>
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
                  <input type="text" disabled class="form-control" name="num_comprobante" placeholder="00000255">
            </div>

         
        </div>
   
        <div class="container p-3 my-3 border" style="background-color: #fff">
    <div class="row">      
                   <div class="col col-lg-3">
                   <label for="nombre">Articulo</label>
                       <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
                            <option selected disabled>Elige un articulo</option>
                             @foreach($articulos as $articulo)
                            <option value="{{$articulo->id}}_{{$articulo->stock}}_{{$articulo->precioarticulo}}">{{$articulo->articulo}}</option> 
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
                  <button type="button" id="bt-add" class="btn btn-primary">+</button>
                  </div>
        </div>    
        <br>       
         <div class="row">
         <div class="col col-lg-12">
         <table class="table table-hover" id="detalle">
           <thead class="thead-dark">
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
      </div>
      
  <div class="row" id="guardar">   
    <div class="form-group col-md-12" >
         <button type="submit" class="btn btn-primary">Registrar</button>
         <button type="reset" class="btn btn-danger">Cancelar</button>
         <a href="{{url('ingreso')}}" class="btn btn-secondary">Volver</a>
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
              var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input type="hidden" name="precio_venta[]" value="'+precio_venta+'">$'+precio_venta+'</td><td><input type="hidden" name="descuento[]" value="'+descuento+'">$'+descuento+'</td><td>$'+subtotal[cont]+'</td></tr>';
              cont++;
              limpiar();
              $("#total").html("$"+total);
              $("#total_venta").val(total);
              evaluar();
              $('#detalle').append(fila);
              }else
              {
                alert("La cantidad a vender supera al stock actual")

              }
          }else
          {
             alert("Complete todos los campos")
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