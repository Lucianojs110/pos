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

    <h2>Crear nuevo Articulo </h2>

    <form action="/articulo" method="POST" enctype="multipart/form-data">
    @csrf
    
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Nombre del Artículo</label>
    <input type="text" class="form-control" name="nombre" placeholder="escribe el nombre del artículo">
    </div>
    <div class="form-group col-md-6">
    <label for="email">Codigo</label>
    <input type="text" class="form-control" name="codigo" placeholder="escribe el codigo del artículo">
    </div>
    </div>
 
 
    <div class="row">
    <div class="form-group col-md-6">
    <label for="email">Descripción</label>
    <input type="text" class="form-control" name="descripcion" placeholder="escribe la descripcion del artículo">
    </div>
    <div class="form-group col-md-6">
    <label for="email">Stock</label>
    <input type="number" class="form-control" name="stock" placeholder="escribe el stock inicial">
    </div>
    </div>
 
  


  <div class="row">
    <div class="form-group col-md-6">
    <label for="categoria">Categoria</label>
    <select name="idcategoria" class="form-control">
    <option selected disabled>Elige una categoría para el artículo..</option>
     @foreach($categoria as $categorias)
     <option value='{{$categorias->id}}'>{{$categorias->nombre}}</option> 
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
    </form>

    @endsection