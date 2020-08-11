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
</form>

</div>
@endsection
