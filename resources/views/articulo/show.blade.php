@extends('layouts.app')

@section('content')
@csrf

<div class="card" style="width:80%; margin-left:auto; margin-right:auto" >

<div class="container">
  <div class="row">
    <div class="col-4" style="margin-top: auto; margin-bottom:auto; margin-left:0px; padding-left:0px">
    @if($articulo->imagen != "")
    <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" alt="{{$articulo->imagen}}" height="100%" width="100%">
    @endif
    </div>
    <div class="col-8" >
    <div class="card-body">
    <h2 > {{{$articulo->nombre}}}</h2>
    <p class="card-text"><h4>Precio de Venta: ${{{$articulo->precio_venta}}}</h4></p>
    <p class="card-text">Codigo: {{{$articulo->codigo}}}</p>
    <p class="card-text">Descripcion: {{{$articulo->descripcion}}}</p>
    <p class="card-text">Stock: {{{$articulo->stock}}}</p>
    

    @foreach($categoria as $categorias)
       @if($categorias->id==$articulo->idcategoria)
          <p class="card-text">Categoria: {{{$categorias->nombre}}}</p>
       @endif  
     @endforeach
    <a href="{{url('articulo')}}" class="btn btn-primary">Volver</a>
  </div>
</div>
    </div>
   
  </div>
</div>


 

@endsection
