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
    <h2>Editar categoría </h2>
    <form action="{{ route('categoria.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{$categoria->nombre}}" placeholder="escribe el nombre de la categoria">
    <br>
    <label for="email">Descripcion</label>
    <input type="text" class="form-control" name="descripcion" value="{{$categoria->descripcion}}" placeholder="escribe la descripcion">
    </div>
    </div>
 
 
 

 
  <button type="submit" class="btn btn-primary">Guardar</button>
  <button type="reset" class="btn btn-danger">Cancelar</button>
  <a href="{{url('categoria')}}" class="btn btn-secondary">Volver</a>
</form>

</div>
</div>
@endsection
