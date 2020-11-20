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
    <h3>Editar cliente: {{$persona->nombre}} </h3>
     </div>
     <div class="container p-4 my-2">    
   
    <form action="{{ route('cliente.update', $persona->id) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    

    <div class="row">
    <div class="form-group col-md-6">
    <label for="numero_documento">Cuit</label>
    <input type="number" class="form-control" maxlength="11" value="{{$persona->num_documento}}"  name="num_documento" id="num_documento" placeholder="escribe el número de documento">
    
    
    </div>
    <div class="form-group col-md-6">
    <label>Tipo de Cliente</label>
    <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" readonly value="{{$persona->tipo}}" name="tipo" id="tipo" placeholder="escribe el tipo de cliente">
    </div>
    </div>
 
 
    <div class="row">
    <div class="form-group col-md-6">
    <label>Nombre o Razon social</label>
    <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" value="{{$persona->nombre}}" name="nombre" id="nombre" placeholder="escribe el nombre del cliente">

    </div>
    <div class="form-group col-md-6">
    <label>Dirección</label>
    <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" value="{{$persona->direccion}}" name="direccion" id="direccion"  placeholder="escribe la dirección del cliente">
    </div>
    </div>
 
  


  <div class="row">
    <div class="form-group col-md-6">
    <label>Teléfono</label>
    <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" value="{{$persona->telefono}}" name="telefono" placeholder="escribe el teléfono del cliente">
    
    </div>
    <div class="form-group col-md-6">
    <label for="email">Email</label>
    <input type="text" class="form-control" value="{{$persona->email}}" name="email" placeholder="escribe el email del cliente">
    </div>
    </div>




    
    


    <button type="submit" class="btn btn-primary">Actualizar</button>
     <button type="reset" class="btn btn-danger">Cancelar</button>
     <a href="{{url('cliente')}}" class="btn btn-secondary">Volver</a>
    </form>
    </div>
    </div>

    @endsection