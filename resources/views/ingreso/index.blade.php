@extends('layouts.app')

@section('content')

    <div class="card" style="background-color: #fff">
    <div class="card-header bg-info mb-3">
    <h3>Ingresos<a href="ingreso/create"><button type="button" class="btn btn-light float-right">Nuevo ingreso</button></a></h3>
     </div>
     <div class="container p-4 my-2">

<table id="data-table" class="table table-sm">
  <thead>
    <tr>
    <th scope="col">id</th>
      <th scope="col">Fecha</th>
      <th scope="col">Proveedor</th>
      <th scope="col">Comprobante</th>
      <th scope="col">Num. comprobante</th>  
      <th scope="col">Total</th>  
      <th scope="col">Estado</th>
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
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('ingreso.index')}}",
        "columns": [
            {data: 'id', name: 'ingreso.id'},
            {data: 'fecha', name: 'ingreso.fecha'},
            {data: 'nombre', name: 'persona.nombre'},
            {data: 'tipo_comprobante', name: 'ingreso.tipo_comprobante'},
            {data: 'num_comprobante', name: 'ingreso.num_comprobante'},
            {data: 'total', name: 'total'},
            {data: 'estado', name: 'ingreso.estado'},
            {data: 'action', name: 'action', sercheable: false, orderable: false},
          
        ],

        columnDefs:[{targets:1, render:function(data){
         return moment(data).format('D-M-YYYY');
         }}],

        'rowCallback': function(row, data, index){
    if(data['estado']== 'Activo'){
        $(row).find('td:eq(6)').css('color', '#4ED020');
        $(row).find('td:eq(6)').css('font-family', 'Impact');
     
        
       
    }else{
        $(row).find('td:eq(6)').css('color', 'red');
        $(row).find('td:eq(6)').css('font-family', 'Impact');
     
    }
    
    },


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
