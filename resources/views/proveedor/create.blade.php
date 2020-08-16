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
    <h2>Crear nuevo Proveedor </h2>
    <form action="/proveedor" method="POST" enctype="multipart/form-data">
    @csrf
    
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Nombre del Proveedor</label>
    <input type="text" class="form-control" name="nombre" placeholder="escribe el nombre del cliente">
    </div>
    <div class="form-group col-md-6">
    <label for="telefono">Teléfono</label>
    <input type="text" class="form-control" name="telefono" placeholder="escribe el teléfono del cliente">
    </div>
    </div>
 
 
    <div class="row">
    <div class="form-group col-md-6">
    <label for="tipo_documento">Tipo documento</label>
    <select name="tipo_documento" class="form-control">
         <option value="DNI">DNI</option>
         <option value="CUIT">CUIT</option>
         <option value="PAS">PAS</option>
     </select>

    </div>
    <div class="form-group col-md-6">
    <label for="numero_documento">Dirección</label>
    <input type="text" class="form-control" name="direccion" placeholder="escribe la dirección del cliente">
    </div>
    </div>
 
  


  <div class="row">
    <div class="form-group col-md-6">
    <label for="numero_documento">Número documento</label>
    <input type="text" class="form-control" name="num_documento" placeholder="escribe el número de documento">
    
    </div>
    <div class="form-group col-md-6">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" placeholder="escribe el email del cliente">
    </div>
    </div>


    <button type="submit" class="btn btn-primary">Registrar</button>
     <button type="reset" class="btn btn-danger">Cancelar</button>
     <a href="{{url('proveedor')}}" class="btn btn-secondary">Volver</a>
    </form>
    </div>

    @endsection