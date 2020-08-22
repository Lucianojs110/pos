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

<div class="container p-3 my-3 border" style="background-color: #fff">   
<div class="container">
  <div class="row">
    <div class="col-4" style="margin-top: auto; margin-bottom:auto; margin-left:0px; padding-left:0px">
    <h2>Editar Articulo: <br>
    {{$articulo->nombre}} </h2>
    </div>
    <div class="col-2" >
    @if($articulo->imagen != "")
    <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" alt="{{$articulo->imagen}}" height="100%" width="100%">
    @endif
    </div>
    <div class="col-4">
    </div>
  </div>
</div>


<form action="{{ route('articulo.update', $articulo->id) }}" method="POST" enctype="multipart/form-data">
   @method('PATCH')
    @csrf
    
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Nombre del Artículo</label>
    <input type="text" class="form-control" name="nombre" value="{{$articulo->nombre}}" placeholder="escribe el nombre del artículo">
    </div>
    <div class="form-group col-md-6">
    <label for="email">Codigo</label>
    <input type="text" class="form-control" name="codigo" value="{{$articulo->codigo}}" placeholder="escribe el codigo del artículo">
    </div>
    </div>
 
 
    <div class="row">
    <div class="form-group col-md-6">
    <label for="email">Descripción</label>
    <input type="text" class="form-control" name="descripcion" value="{{$articulo->descripcion}}" placeholder="escribe la descripcion del artículo">
    </div>
    <div class="form-group col-md-6">
    <label for="email">Stock</label>
    <input type="number" class="form-control" name="stock" value="{{$articulo->stock}}" placeholder="escribe el stock inicial">
    </div>
    </div>
 
  


  <div class="row">
    <div class="form-group col-md-6">
    <label for="categoria">Categoria</label>
    <select name="idcategoria" class="form-control">
    <option selected disabled>Elige una categoría para el artículo..</option>
     @foreach($categoria as $categorias)
       @if($categorias->id==$articulo->idcategoria)
          <option value='{{$categorias->id}}'selected>{{$categorias->nombre}}</option> 
        @else
           <option value='{{$categorias->id}}'>{{$categorias->nombre}}</option> 
        @endif   

     @endforeach
     </select>
    </div>
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

    @endsection