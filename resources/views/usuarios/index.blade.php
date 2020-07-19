@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Usuarios registrados <a href="usuarios/create"><button type="button" class="btn btn-success float-right">Agregar usuario</button></a></h2>
<table id="data-table" class="table ">
  <thead class="thead-dark">
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Rol</th>
      <th scope="col">imagen</th>
      <th scope="col" width="130px">Acciones</th>
      
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
</div>


<script>
	

$(document).ready(function() {
    $('#data-table').DataTable( {
      
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('usuarios.index')}}",
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'rol', name: 'rol'},
            {data: 'imagen', name: 'imagen', sercheable: false},
            {data: 'action', name: 'action', sercheable: false, orderable: false},
        ]
    } );
} );
</script>

@endsection
