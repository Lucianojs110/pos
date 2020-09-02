@extends('layouts.app')

@section('content')

<div class="card" style="background-color: #fff">
    <div class="card-header bg-info mb-3">
    <h3>Lista de Ventas<a href="venta/create"><button type="button" class="btn btn-light float-right">Nueva Venta</button></a></h3>
     </div>
     <div class="container p-4 my-2">



    
<table id="data-table" class="table table-sm">
  <thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Numero</th>
    <th scope="col">Fecha</th>
    <th scope="col">Cliente</th>
    <th scope="col">Tipo</th>  
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
      
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('venta.index')}}",
        "columns": [
            {data: 'id', name: 'venta.id'},
            {data: 'num_comprobante', name: 'venta.num_comprobante'},
            {data: 'fecha', name: 'venta.fecha', type: 'date-dd-mmm-yyyy', targets: 0},
            {data: 'nombre', name: 'persona.nombre'},
            {data: 'tipo_comprobante', name: 'venta.tipo_comprobante'},
            {data: 'total', name: 'venta.total'},
            {data: 'estado', name: 'venta.estado'},
            {data: 'action', name: 'action', sercheable: false, orderable: false},
          
        ],

        columnDefs:[{targets:2, render:function(data){
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
