@extends('layouts.app')

@section('content')
@csrf

<div class="card" style="width:30%; margin-left:auto; margin-right:auto">
@if($user->imagen != "")
    <img src="{{asset('imagenes/'.$user->imagen)}}" alt="{{$user->imagen}}" height="100%" width="100%">
    @endif
  <div class="card-body">
    <h4 class="card-title">{{{$user->name}}}</h4>
    <p class="card-text">{{{$user->email}}}</p>
    <a href="{{url('usuarios')}}" class="btn btn-primary">Volver</a>
  </div>
</div>

@endsection
