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
    <form action="{{url('venta')}}" method="POST" enctype="multipart/form-data">
    @csrf
    
    
    <div class="row">
        <div class="form-group col-md-6">
              <label for="nombre">Cliente</label>
              <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
              <option value="1" selected>CONSUMIDOR FINAL</option>
                @foreach($personas as $persona)
              <option value='{{$persona->id}}_{{$persona->tipo}}_{{$persona->num_documento}}'>{{$persona->nombre}}</option> 
                @endforeach
              </select>
              <input type="text" hidden class="form-control" id="idcliente2" name="idcliente2" value="1" >
              <input type="text" hidden class="form-control" id="cuit" name="cuit" >
          </div>

            <div class="form-group col-md-3">
                <label>Tipo Comprobante</label>
                <input type="text" readonly class="form-control" id="tipo_comprobante" name="tipo_comprobante" value="FACTURA {{$tipo_comprobante}}" >

            </div>
            <div class="form-group col-md-3">
                  <label>Número Comprobante</label>
                  <input type="text" readonly class="form-control" id="num_comprobante" name="num_comprobante" value={{$punto}}-{{$numComp}}>
            </div>
        </div>
        <div class="container p-3 my-3 border" style="background-color: #fff">
        <div class="row" >      
                   <div class="form-group col-lg-3">
                   <label for="nombre">Articulo</label>
                       <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
                            <option selected disabled>Elige un articulo</option>
                             @foreach($articulos as $articulo)
                            <option value="{{$articulo->id}}_{{$articulo->stock}}_{{$articulo->precio_venta}}">{{$articulo->articulo}}</option> 
                            @endforeach
                       </select>
                   </div>
                   <div class="form-group col-lg-2"> 
                        <label>Cantidad</label>
                        <input type="number" class="form-control" id="pcantidad" name="cantidad" placeholder="cantidad">
                  </div>
                  <div class="form-group col-lg-2"> 
                        <label>stock</label>
                        <input type="number" disabled class="form-control" id="pstock" name="pstock" placeholder="stock">
                  </div>
                  <div class="form-group col-lg-2"> 
                        <label>Precio venta</label>
                        <input type="number" class="form-control" id="pprecio_venta" name="pprecio_venta" placeholder="P. venta">
                  </div>
                  <div class="form-group col-lg-2"> 
                        <label>Descuento</label>
                        <input type="number" class="form-control" id="pdescuento" name="stock" placeholder="descuento">
                  </div>
                  <div class="form-group col-lg-1" style="margin-top:auto"> 
                  <button type="button" id="bt-add" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                  </div>
        </div>    
        <br>       
         <div class="row">
         <div class="col col-lg-12">
         <div class="table-responsive-sm">
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
         </div>
         </div> 
      
      
  <div class="row" id="guardar">   
    <div class="form-group col-md-12" >
         <button type="submit" class="btn btn-primary">Registrar</button>
         <button type="reset" class="btn btn-danger">Cancelar</button>
         <a href="{{url('venta')}}" class="btn btn-secondary">Volver</a>
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
          $("#idcliente").change(tipoFactura);
          
           
    });

       total=0;
      var cont=0;
      subtotal=[];
     

      function tipoFactura()
      {
        datosPersona= document.getElementById('idcliente').value.split('_');
        $("#idcliente2").val(datosPersona[0]);
        if ($("#tipo_comprobante").val() != 'Factura C'){

        if (datosPersona[1] == 'RESP. INSCRIPTO'){
          $("#tipo_comprobante").val('FACTURA A');
          $("#idcliente2").val(datosPersona[0]);
          $("#cuit").val(datosPersona[2]);
          lastVoucher()
        }else {
          $("#tipo_comprobante").val('FACTURA B');
          $("#idcliente2").val(datosPersona[0]);
          lastVoucher()
        }
        }
      }

      function lastVoucher()
      {
      $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "POST",
            url: "{{route('lastVoucher')}}",
            dataType: "json",
            data: {
             
                tipo: $("#tipo_comprobante").val(),    
            },
            success: function(data) {
              
              $("#num_comprobante").val(data.punto+'-'+data.numComp)
            },
           
        });
        return false;
      }

      function mostrarValores()
      {
        datosArticulos= document.getElementById('pidarticulo').value.split('_');
        $("#pprecio_venta").val(datosArticulos[2]);
        $("#pstock").val(datosArticulos[1]);
        $("#pcantidad").val('1');
        $("#pdescuento").val('0');

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
             if(parseInt(stock) >= parseInt(cantidad)){
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