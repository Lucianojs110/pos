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
    <h3>Editar Articulo: 
    {{$articulo->nombre}} </h3>
    </div>
     <div class="container p-4 my-2"> 


<form action="{{ route('articulo.update', $articulo->id) }}" method="POST" enctype="multipart/form-data">
   @method('PATCH')
    @csrf
    
 
  
  <div class="row">
  
  <div class="col-sm">
    
  <div class="container border" style="border:2px">
  <div class="card-body">
  @if($articulo->imagen != "")
    <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" alt="{{$articulo->imagen}}" height="50%" width="50%" style="margin-left:auto; margin-right:auto">
    @endif
  
  <input type="file" class="form-control" name="imagen" >
  </div>
</div>
  
    </div>
    
    
    
    <div class="col-sm">
    <label>Nombre del Artículo</label>
    <input type="text" class="form-control" name="nombre" value="{{$articulo->nombre}}" placeholder="escribe el nombre del artículo">  
    <label>Codigo</label>
    <input type="text" class="form-control" name="codigo" value="{{$articulo->codigo}}" placeholder="escribe el codigo del artículo">
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
    <div class="col-sm">
     
    <label>Descripción</label>
    <input type="text" class="form-control" name="descripcion" value="{{$articulo->descripcion}}" placeholder="escribe la descripcion del artículo">
    <label>Stock</label>
    <input type="number" class="form-control" name="stock" value="{{$articulo->stock}}" placeholder="escribe el stock inicial">
    <label>Precio Venta</label>
    <input type="number" class="form-control" name="precio_venta" value="{{$articulo->precio_venta}}" placeholder="escribe el precio de venta">
    </div>
   </div>

<br>

    <div class="row">
    <div class="col-sm">
    <button type="submit" class="btn btn-primary">Registrar</button>
     <button type="reset" class="btn btn-danger">Cancelar</button>
     <a href="{{url('articulo')}}" class="btn btn-secondary">Volver</a>
     </div>
     </div>
    </form>

    
    </div>
    </div>
    
    @endsection