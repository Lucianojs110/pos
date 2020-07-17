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

    <h2>Crear nuevo usuario </h2>

    <form action="/usuarios" method="POST" enctype="multipart/form-data">
    @csrf
    
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="name" placeholder="escribe tu nombre">
    </div>
    <div class="form-group col-md-6">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" placeholder="escribe tu Email">
    </div>
    </div>
 
 
    <div class="row">
    <div class="form-group col-md-6">
    <label for="Contraseña">Contraseña</label>
    <input type="password" class="form-control" name="password" placeholder="Contraseña">
    </div>
    <div class="form-group col-md-6">
    <label for="Contraseña">Confirmar Contraseña</label>
    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirme contraseña">
    </div>
    </div>
 
  


  <div class="row">
    <div class="form-group col-md-6">
    <label for="rol">Rol</label>
    <select name="rol" class="form-control">
    <option selected disabled>Elige un rol para el usuario..</option>
     @foreach($roles as $role)
     <option value='{{$role->id}}'>{{$role->name}}</option> 
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

</div>
@endsection
