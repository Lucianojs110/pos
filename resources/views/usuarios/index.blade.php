@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Usuarios registrados <a href="usuarios/create"><button type="button" class="btn btn-success float-right">Agregar usuario</button></a></h2>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Rol</th>
      <th scope="col">imagen</th>
      <th scope="col">Acciones</th>
      
    </tr>
  </thead>
  <tbody>
      @foreach($users as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
      @foreach($user->roles as $role)
      {{$role->name}}
      @endforeach
      </td>
      <td>
      <img src="{{asset('imagenes/'.$user->imagen)}}" alt="{{$user->imagen}}" height="40px" width="40px">
      </td>
      <td>
     
        <form action="{{ route('usuarios.destroy', $user->id)}}" method="POST">
        <a href="{{ route('usuarios.show', $user->id)}}"><button type="button" class="btn btn-secondary"><i class="far fa-eye"></i></button></a>
      <a href="{{ route('usuarios.edit', $user->id)}}"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
        </form>
        
      
      </td>
    </tr>
      @endforeach
  </tbody>
</table>
</div>
@endsection
