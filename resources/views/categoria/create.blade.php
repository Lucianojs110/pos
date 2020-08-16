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
    <h2>Crear nueva categoría </h2>

    <form action="/categoria" method="POST" enctype="multipart/form-data">
    @csrf
    
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" placeholder="escribe el nombre de la categoría">
    <br>
    <label for="email">Descripcion</label>
    <input type="text" class="form-control" name="descripcion" placeholder="escribe la descripción">
    </div>
    </div>
 
 
 

 
  <button type="submit" class="btn btn-primary">Guardar</button>
  <button type="reset" class="btn btn-danger">Cancelar</button>
  <a href="{{url('categoria')}}" class="btn btn-secondary">Volver</a>
</form>

</div>
</div>
@endsection
