@extends('layouts.app')

@section('content')
@csrf

<div class="card" style="width:40%; margin-left:auto; margin-right:auto" >

<div class="container">
  
   
    <div class="card-body">
    <h2 > {{{$persona->nombre}}}</h2>
    <p class="card-text">Cuit / Cuil: {{{$persona->num_documento}}}</p>
    <p class="card-text">Dirección: {{{$persona->direccion}}}</p>
    <p class="card-text">Teléfono: {{{$persona->telefono}}}</p>
    <p class="card-text">email: {{{$persona->email}}}</p>
   
    <a href="{{url('cliente')}}" class="btn btn-primary">Volver</a>
  </div>

    </div>
   
  </div>
</div>


 

@endsection