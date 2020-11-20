@extends('layouts.app')

@section('content')

<div class="container-fluid">
<div class="row">
		  <div class="col-md-3">
          <a href="{{url('venta/create')}}">
            <div class="info-box bg-primary">
              <span class="info-box-icon"><i class="far fa-money-bill-alt"></i></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Nueva venta</span>
                </div>
            </div>
          </a>
		  </div>
      <div class="col-md-3">
          <a href="{{url('cliente/create')}}">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fas fa-user"></i></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Nuevo Cliente</span>
                </div>
            </div>
          </a>
		  </div>
      <div class="col-md-3">
          <a href="{{url('cliente/create')}}">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fas fa-file-invoice"></i></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Nuevo Remito</span>
                </div>
            </div>
          </a>
		  </div>
      <div class="col-md-3">
          <a href="{{url('cliente/create')}}">
            <div class="info-box bg-secondary">
              <span class="info-box-icon"><i class="fas fa-file-invoice"></i></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Nuevo Presupuesto</span>
                </div>
            </div>
          </a>
		  </div>
	  </div>
	<div class="row">
		<div class="form-group col-md-3">
    <div  class="card" style="background-color: #fff;"> 
    <div id="logo">
                @foreach($tiendas as $tienda)
                       @if($tienda->logo != "")
                      <img src="{{asset('imagenes/'.$tienda->logo)}}" alt="{{$tienda->logo}}" class="card-img-top" height="230rem" width="100rem">
                       @endif
                       <div class="card-body">
                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#actualizarLogo">
                      Cambiar logo 
                     </button>
                      </div>
                  @endforeach  
                  
    </div>
    </div>    
   </div>
   <div class="form-group col-md-5">

   <div  class="card"  style="background-color: #fff"> 
      <div id="datos">
                @foreach($tiendas as $tienda)
                    
                     
                     <div class="card-body">
                     <h3 style="color: #1A5276"> {{{$tienda->nombre_fantasia}}}</h3>
                     <p class="card-text">Propietario: {{{$tienda->nombre}}}</p>
                     <p class="card-text">Direccion: {{{$tienda->direccion}}}</p>
                     <p class="card-text">Cuit: {{{$tienda->cuit}}}</p>
                     <p class="card-text">Punto de Venta: {{{$tienda->punto_venta}}}</p>
                     
                     @if($tienda->responsable == 11)
                     <p class="card-text">Iva: Monotributo </p>
                     @else
                     <p class="card-text">Iva: Responsable Inscripto </p>
                     @endif
                     
                     
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#actualizarDatos">
                      Actualizar Datos
                     </button>
                @endforeach   
                   </div>
        </div>            
    </div>
                  
   </div>
   
   

		<div class="form-group col-md-4">
         
          <div class="small-box bg-info">
          <div class="inner">
            <h3>150</h3>
          <p>Ventas</p>
          </div>
          <div class="icon">
          <i class="fas fa-shopping-cart"></i>
          </div>
          <a href="#" class="small-box-footer">
          Ver listado <i class="fas fa-arrow-circle-right"></i>
          </a>
          </div>


          <div class="small-box bg-gradient-success">
          <div class="inner">
          <h3>44</h3>
          <p>Clientes</p>
          </div>
          <div class="icon">
          <i class="fas fa-user-plus"></i>
          </div>
          <a href="#" class="small-box-footer">
          Ver listado <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
    </div>
	</div>
  </div>
	 
  </div>







<!-- Modal datos-->
<div class="modal fade" id="actualizarDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingrese los nuevos datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group col-md-12">
       <label for="nombre">Nombre de Fantasia </label>
       <input type="text" class="form-control" id="fantasia" name="fantasia" value=" {{{$tienda->nombre_fantasia}}}"  placeholder="Ingrese el nombre de fantasia">
       <label for="nombre">Razon Social </label>
       <input type="text" class="form-control" id="nombre" name="nombre"  value=" {{{$tienda->nombre}}}"  placeholder="Ingrese el nombre el propietario">
       <label for="nombre">Cuit </label>
       <input type="text" class="form-control" id="cuit" name="cuit" value=" {{{$tienda->cuit}}}"   placeholder="Ingrese el cuit">
       <label for="nombre">Dirección </label>
       <input type="text" class="form-control" id="direccion" name="direccion" value=" {{{$tienda->direccion}}}"  placeholder="Ingrese la direccion de la tienda">
       <label>Condicion ante el Iva</label>
             <select name="iva" id="iva" class="form-control">
             <option value="6">Responsable Inscripto</option>
             <option value="11">Monotributo</option>
             </select>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
        <button type="button" id="guardar" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
</div>  
</div>
<!-- Fin Modal datos-->


<!-- Modal LOGO-->
<div class="modal fade" id="actualizarLogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group col-md-12">
      <form id="form" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <label>Seleccione un nuevo logo</label>
      <input type="file" class="form-control" name="select_file" id="select_file" >
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
      <input type="submit" id="upload" class="btn btn-primary" value="guardar">
        </form>
      </div>
      
        
      </div>
      
     
    </div>
  </div>
</div>  
</div>
<!-- Fin Modal LOGO-->

@push('scripts')
<script>
$(document).ready(function(){
    
    function limpiar(){
         
      $("#select_file").val('');
        

   }


    $("#form").submit(function(e){
        e.preventDefault();
     
        $.ajax({
           
            method: "POST",
            url: "{{route('updatelogo')}}",
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function(data) {
               if(data.res == 0){
                $('#actualizarLogo').modal('hide').toggle("slow");
                $("#logo").load(" #logo");
                toastr.success(data.message);
                limpiar();
               }else{
        
                toastr.warning(data.message);
                limpiar();
               }
              
            }
        });
        return false;
    });
             
    $('#guardar').on('click', function(event)
    {
              
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "POST",
            url: "{{route('update')}}",
            dataType: "html",
            data: {
                id: '1',
                nombre: $("#nombre").val(),
                fantasia: $("#fantasia").val(),
                cuit: $("#cuit").val(),
                direccion: $("#direccion").val(),
                iva: $("#iva").val(),
                
                   
            },
            success: function(data) {
                toastr.success("Datos actualizados correctamente")
                $('#actualizarDatos').modal('hide').toggle("slow");
                $("#datos").load(" #datos");

            },
            error: function(){
                toastr.warning("Complete todos los campos")
            }
        });
        return false;
    
    });     
    });
</script>
@endpush
@endsection


