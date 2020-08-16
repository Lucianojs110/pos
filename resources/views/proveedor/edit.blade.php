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
    <h2>Editar cliente: {{$persona->nombre}} </h2>
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

    @endsection