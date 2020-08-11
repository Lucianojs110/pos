@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Artículos <a href="articulo/create"><button type="button" class="btn btn-success float-right">Agregar Articulo</button></a></h2>
<table id="data-table" class="table ">
  <thead class="thead-dark">
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Codigo</th>
      <th scope="col">Descripción</th>
      <th scope="col">Stock</th>
      <th scope="col">Categoría</th>
      <th scope="col">Imagen</th>
      
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
        "ajax": "{{ route('articulo.index')}}",
        "columns": [
            {data: 'id', name: 'articulo.id'},
            {data: 'nombrearticulo', name: 'articulo.nombre'},
            {data: 'codigo', name: 'articulo.codigo'},
            {data: 'descripcion', name: 'articulo.descripcion'},
            {data: 'stock', name: 'articulo.stock', sercheable: false},
            {data: 'nombre', name: 'categoria.nombre', sercheable: false},
            {data: 'imagen', name: 'articulo.imagen', sercheable: false},
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
