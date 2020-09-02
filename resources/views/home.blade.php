@extends('layouts.app')

@section('content')

<div class="card" style="background-color: #fff">
    <div class="card-header bg-info mb-3">
    <h3>Bienvenido...</h3> 
    </div>
<div class="container p-4 my-2">
                @foreach($tiendas as $tienda)
               
                <div class="row">
                   <div class="col-4" style="margin-top: auto; margin-bottom:auto;">
                       @if($tienda->logo != "")
                      <img src="{{asset('imagenes/'.$tienda->logo)}}" alt="{{$tienda->logo}}" height="100%" width="100%">
                       @endif
                    </div>
                <div class="col-8" >
                   <div class="card-body">
                     <h2 > {{{$tienda->nombre_fantasia}}}</h2>
                     <p class="card-text">Propietario: {{{$tienda->nombre}}}</p>
                     <p class="card-text">Direccion: {{{$tienda->direccion}}}</p>
                     <p class="card-text">Cuit: {{{$tienda->cuit}}}</p>
                     <p class="card-text">Iva: {{{$tienda->responsable}}}</p>
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#actualizarLogo">
                      Cambiar logo 
                     </button>
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#actualizarDatos">
                      Actualizar Datos
                     </button>
                     
                   </div>
                </div>
                </div>
                </div>
                </div>
                @endforeach

              
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
             <option value="Resp. Inscripto">Responsable Inscripto</option>
             <option value="Monotributo">Monotributo</option>
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
                $("#card").load(" #card > *");
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
        
       nombre= $("#nombre").val();
       fantasia= $("#fantasia").val();
       cuit= $("#cuit").val();
       direccion= $("#direccion").val();
        if (nombre != ""  || fantasia != "" || cuit != "" || direccion != "" ) {
           
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
                $("#card").load(" #card > *");

            },
            error: function(){
                toastr.warning("Complete todos los campos")
            }
        });
        return false;
    }
    toastr.warning("Complete todos los campos")
    });


   

  
          
    });




</script>
@endpush
@endsection


