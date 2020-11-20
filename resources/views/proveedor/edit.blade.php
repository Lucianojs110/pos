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
    <h3>Editar Proveedor: {{$persona->nombre}}</h3>
    </div>
 <div class="container p-2 my-2"> 
  
    
    <form action="{{ route('proveedor.update', $persona->id) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Nombre del cliente</label>
    <input type="text" class="form-control" value="{{$persona->nombre}}" name="nombre" placeholder="escribe el nombre del cliente">
    </div>
    <div class="form-group col-md-6">
    <label for="telefono">Teléfono</label>
    <input type="text" class="form-control" value="{{$persona->telefono}}"  name="telefono" placeholder="escribe el teléfono del cliente">
    </div>
    </div>
 
 
    <div class="row">
    <div class="form-group col-md-6">
    <label for="tipo_documento">Tipo documento</label>
    <select name="tipo_documento" class="form-control">
        @if($persona->tipo_documento=='DNI')
         <option value="DNI" selected>DNI</option>
         <option value="CUIT">CUIT</option>
         <option value="PAS">PAS</option>
        @elseif($persona->tipo_documento=='CUIT')
        <option value="CUIT"  selected>CUIT</option>
         <option value="DNI">DNI</option>
         <option value="PAS">PAS</option> 
         @else
         <option value="PAS" selected>PAS</option> 
         <option value="DNI">DNI</option>
         <option value="CUIT">CUIT</option>
         
         @endif
     </select>

    </div>
    <div class="form-group col-md-6">
    <label for="numero_documento">Dirección</label>
    <input type="text" class="form-control" value="{{$persona->direccion}}"  name="direccion" placeholder="escribe la dirección del cliente">
    </div>
    </div>
 
  


  <div class="row">
    <div class="form-group col-md-6">
    <label for="numero_documento">Número documento</label>
    <input type="text" class="form-control" value="{{$persona->num_documento}}"  name="num_documento" placeholder="escribe el número de documento">
    
    </div>
    <div class="form-group col-md-6">
    <label for="email">Email</label>
    <input type="text" class="form-control" value="{{$persona->email}}"  name="email" placeholder="escribe el email del cliente">
    </div>
    </div>


    <button type="submit" class="btn btn-primary">Actualizar</button>
     <button type="reset" class="btn btn-danger">Cancelar</button>
     <a href="{{url('cliente')}}" class="btn btn-secondary">Volver</a>
    </form>
    </div>
    </div>

    @endsection