@extends('layouts.app')

@section('content')
<div class="card" style="background-color: #fff">
    <div class="card-header bg-info mb-3">
    <h3>Lista de Categorías <a href="categoria/create"><button type="button" class="btn btn-light float-right">Agregar Categoria</button></a></h3>
    </div>
<div class="container p-4 my-2"> 

    
<table id="data-table" class="table ">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      
      <th scope="col" width="130px">Acciones</th>
      
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
</div>
</div>

<script>
	

$(document).ready(function() {
    $('#data-table').DataTable( {
      
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('categoria.index')}}",
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'nombre', name: 'nombre'},
            {data: 'descripcion', name: 'descripcion'},
            {data: 'action', name: 'action', sercheable: false, orderable: false},
          
        ],
        "language":{
         
              "decimal":        "",
              "emptyTable":     "No hay datos",
              "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
              "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
              "infoFiltered":   "(Filtro de _MAX_ total registros)",
              "infoPostFix":    "",
              "thousands":      ",",
              "lengthMenu":     "Mostrar _MENU_ registros",
              "loadingRecords": "Cargando...",
              "processing":     "Procesando...",
              "search":         "Buscar:",
              "zeroRecords":    "No se encontraron coincidencias",
              "paginate": {
              "first":      "Primero",
              "last":       "Ultimo",
              "next":       "Próximo",
              "previous":   "Anterior"
               },
                "aria": {
               "sortAscending":  ": Activar orden de columna ascendente",
               "sortDescending": ": Activar orden de columna desendente"
         }
        }
    } );
} );
</script>

@endsection
