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
    <h3>Crear nuevo cliente </h3> 
     </div>
     <div class="container p-4 my-2">
    <form action="{{url('cliente')}}" method="POST" enctype="multipart/form-data">
    @csrf
    
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="numero_documento">Cuit</label>
    <input type="number" class="form-control" maxlength="11" name="num_documento" id="num_documento" placeholder="escribe el número de documento">
    
    
    </div>
    <div class="form-group col-md-6">
    <label>Tipo de Cliente</label>
    <input type="text" class="form-control" readonly name="tipo" id="tipo" placeholder="escribe el tipo de cliente">
    </div>
    </div>
 
 
    <div class="row">
    <div class="form-group col-md-6">
    <label>Nombre o Razon social</label>
    <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" name="nombre" id="nombre" placeholder="escribe el nombre del cliente">

    </div>
    <div class="form-group col-md-6">
    <label>Dirección</label>
    <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" name="direccion" id="direccion"  placeholder="escribe la dirección del cliente">
    </div>
    </div>
 
  


  <div class="row">
    <div class="form-group col-md-6">
    <label>Teléfono</label>
    <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" name="telefono" placeholder="escribe el teléfono del cliente">
    
    </div>
    <div class="form-group col-md-6">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" placeholder="escribe el email del cliente">
    </div>
    </div>


    <button type="submit" class="btn btn-primary">Registrar</button>
     <button type="reset" class="btn btn-danger">Cancelar</button>
     <a href="{{url('cliente')}}" class="btn btn-secondary">Volver</a>
    </form>
    </div>
    </div>

<script>

$(document).ready(function(){
    $("#num_documento").on('change keyup paste', function () {
    
        if($(this).val().length == 11) {

            $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "POST",
            url: "{{route('consultarcuit')}}",
            dataType: "json",
            data: {

                num_documento: $("#num_documento").val(),
            },
            success: function(data) {
               console.log(data);
              
              if (data.persona == null || data.persona.datosRegimenGeneral == null){
                $("#tipo").val('CONSUMIDOR FINAL');
                toastr.warning("Cuit no registrado como contribuyente")
              
            }else
            {
                if(data.persona.datosRegimenGeneral.impuesto.idImpuesto == '5048' )
                 {
                   $("#nombre").val(data.persona.datosGenerales.apellido+' '+data.persona.datosGenerales.nombre);
                   $("#tipo").val('MONOTRIBUTO');
                   $("#direccion").val(data.persona.datosGenerales.domicilioFiscal.direccion+' - '+data.persona.datosGenerales.domicilioFiscal.localidad+' - '+data.persona.datosGenerales.domicilioFiscal.descripcionProvincia);
                 }
               else if   (data.persona.datosRegimenGeneral.impuesto[1].idImpuesto == '30')
                {
                  $("#nombre").val(data.persona.datosGenerales.razonSocial);
                  $("#tipo").val('RESP. INSCRIPTO');
                  $("#direccion").val(data.persona.datosGenerales.domicilioFiscal.direccion+' - '+data.persona.datosGenerales.domicilioFiscal.localidad+' - '+data.persona.datosGenerales.domicilioFiscal.descripcionProvincia);
                }
               
            };
               
            },
            error: function(){
                toastr.warning("Ocurrio un problema")
            }
        });
        return false;


            
         }; 
    
  });   



    });

</script>

    @endsection