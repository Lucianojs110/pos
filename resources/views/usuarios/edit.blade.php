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
    <h4>Editar usuario: {{$user->name}}</h4>
    </div>
<div class="container p-4 my-2"> 

<div class="card" style="width:10%">
    @if($user->imagen != "")
    <img src="{{asset('imagenes/'.$user->imagen)}}" alt="{{$user->imagen}}" height="100%" width="100%">
    @endif
 
</div>





<form action="{{ route('usuarios.update', $user->id) }}" method="POST" enctype="multipart/form-data">
   @method('PATCH')
    @csrf
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="escribe tu nombre">
    </div>
    <div class="form-group col-md-6">
    <label for="email">Email</label>
    <input type="email" class="form-control" value="{{$user->email}}" name="email" placeholder="escribe tu Email">
    </div>
    </div>
 
 
    <div class="row">
    <div class="form-group col-md-6">
    <label for="Contraseña">Contraseña <span class="small">(Opcional)</span></label>
    <input type="password" class="form-control" name="password" placeholder="Contraseña">
    </div>
    <div class="form-group col-md-6">
    <label for="Contraseña">Confirmar Contraseña <span class="small">(Opcional)</span></label>
    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirme contraseña">
    </div>
    </div>
 

    <div class="row">
    <div class="form-group col-md-6">
    <label for="rol">Rol</label>
    <select name="rol" class="form-control">
    <option selected disabled>Elige un rol para el usuario..</option>
     @foreach($roles as $role)
     @if($role->name == str_replace(array('["','"]'), '', $user->tieneRol()))
     <option value="{{$role->id}}" selected>{{$role->name}}</option> 
     @else
     <option value="{{$role->id}}">{{$role->name}}</option>
     @endif
     @endforeach
     </select>
    
    </div>
    <div class="form-group col-md-6">
    <label>Imagen</label>
    <input type="file" class="form-control" name="imagen" >
   
   
    
    </div>
    </div>
 
  
  
 
  <button type="submit" class="btn btn-primary">Guardar</button>
  <button type="reset" class="btn btn-danger">Cancelar</button>
  <a href="{{url('usuarios')}}" class="btn btn-secondary">Volver</a>
</form>

</div>
</div>
</div>
@endsection