@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
        @if ($errors->any())
          <div class='alert alert-danger'>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
          </ul>
        </div>
        @endif
      </div>
</div>

    <div class="container p-3 my-3 border" style="background-color: #fff">
    <h2>Nuevo Ingreso </h2>
    <form action="/ingreso" method="POST" enctype="multipart/form-data">
    @csrf
    
    
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Proveedor</label>
    <select name="idproveedor" id="idproveedor" class="form-control">
    <option selected disabled>Elige un proveedor</option>
     @foreach($personas as $persona)
     <option value='{{$persona->id}}'>{{$persona->nombre}}</option> 
     @endforeach
     </select>
    </div>
   
   
    <div class="form-group col-md-12">
    <div class="row">
    <div class="form-group col-md-4">
    <label for="tipo_documento">Tipo compprobante</label>
    <select name="tipo_comprobante" class="form-control">
         <option value="Factura A">Factura A</option>
         <option value="Factura B">Factura B</option>
         <option value="Factura C">Factura C</option>
     </select>

    </div>
    <div class="form-group col-md-4">
    <label for="numero_documento">Número Comprobante</label>
    <input type="text" class="form-control" name="num_comprobante" placeholder="escribe el numero de comprobante">
    </div>

    <div class="form-group col-md-4">
    <label for="numero_documento">fecha</label>
    <input type="text" class="form-control" name="fecha" placeholder="fecha">
    </div>
    </div>
    </div>
    </div>
    <div class="row">
        <div class="panel panel-primary">
           <div class="panel-body">
                <div class="form-group col-md-12">
                    <label for="nombre">Articulo</label>
                       <select name="pidarticulo" id="pidarticulo" class="form-control" >
                            <option selected disabled>Elige un articulo</option>
                             @foreach($articulos as $articulos)
                            <option value='{{$articulos->id}}'>{{$articulos->articulo}}</option> 
                            @endforeach
                       </select>

                      
                       


                </div>
            </div>
        </div>
    
    
    
    <div class="form-group col-md-12">
    <button type="submit" class="btn btn-primary">Registrar</button>
     <button type="reset" class="btn btn-danger">Cancelar</button>
     <a href="{{url('ingreso')}}" class="btn btn-secondary">Volver</a>
     </div>
     </div>
    
   
    </form>

 <script>
          $.fn.selectpicker.Constructor.BootstrapVersion = '4';
          $('select').selectpicker();


 </script>

    @endsection