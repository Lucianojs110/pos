@extends('layouts.app')

@section('content')


    
     <div class="card" style="background-color: #fff">
        <div class="card-header bg-info mb-3">
        <h3>Crear nueva categoría </h3>
    </div>
     <div class="container p-4 my-2"> 



    <form action="{{url('categoria')}}"  method="POST" enctype="multipart/form-data">
    @csrf
    
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="escribe el nombre de la categoría" required>
    <br>
    <label for="descripcion">Descripcion</label>
    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" placeholder="escribe la descripción" required>
    </div>
    </div>
 
 
 

 
  <button type="submit" class="btn btn-primary">Guardar</button>
  <button type="reset" class="btn btn-danger">Cancelar</button>
  <a href="{{url('categoria')}}" class="btn btn-secondary">Volver</a>
</form>

</div>
</div>
</div>

@endsection
