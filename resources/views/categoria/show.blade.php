@extends('layouts.app')

@section('content')
@csrf
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">{{{$categoria->nombre}}}</h1>
    <p class="lead">{{{$categoria->descripcion}}}</p>
  </div>
</div>

@endsection
