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
    <h3>Crear nuevo artículo </h3>  
     </div>
     <div class="container p-4 my-2">
    
    <form action="{{url('articulo')}}" method="POST" enctype="multipart/form-data">
    @csrf
    
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Nombre del Artículo</label>
    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="escribe el nombre del artículo">
    </div>
    <div class="form-group col-md-6">
    <label for="email">Codigo</label>
    <input type="text" class="form-control" name="codigo" value="{{ old('codigo') }}" placeholder="escribe el codigo del artículo">
    </div>
    </div>
 
 
    <div class="row">
    <div class="form-group col-md-6">
    <label for="email">Descripción</label>
    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" placeholder="escribe la descripcion del artículo">
    </div>
    <div class="form-group col-md-6">
    <label for="email">Stock</label>
    <input type="number" class="form-control" name="stock" value="{{ old('stock') }}" placeholder="escribe el stock inicial">
    </div>
    </div>
 
  


  <div class="row">
    <div class="form-group col-md-6">
    <label for="categoria">Categoria</label>
    <select name="idcategoria" class="form-control" value="{{ old('idcategoria') }}">
    <option selected disabled>Elige una categoría para el artículo..</option>
     @foreach($categoria as $categorias)
     <option value='{{$categorias->id}}'>{{$categorias->nombre}}</option> 
     @endforeach
     </select>
    </div>
    <div class="form-group col-md-6">
    <label for="email">Precio Venta</label>
    <input type="number" class="form-control" name="precio_venta" value="{{ old('precio_venta') }}" placeholder="ingresa el precio venta">
    
    </div>
    </div>

    <div class="row">
    <div class="form-group col-md-6">
    <label>Imagen</label>
    <input type="file" class="form-control" name="imagen" >
    </div>
    </div>
  


    <button type="submit" class="btn btn-primary">Registrar</button>
     <button type="reset" class="btn btn-danger">Cancelar</button>
     <a href="{{url('articulo')}}" class="btn btn-secondary">Volver</a>
    </form>
    </div>   
    </div>

    @endsection