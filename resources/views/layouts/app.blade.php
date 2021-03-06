<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>easyPOS</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    @stack('scripts')
    <script src="https:////cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"defer></script>

    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"defer></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"defer></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>


   
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css" rel="stylesheet" >
    <link href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div id="app">
    <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>


                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                <div class="user-panel" style="padding-right: 15px; ">
                                @guest
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                @else
                                <div class="image">
                               <img  src="{{asset('imagenes/'.Auth::user()->imagen)}}" class="img-circle elevation-2" alt="User Image" >
                                </div>
                                {{ Auth::user()->name }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                @endguest
                            </a>
                </div>
                  
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                    <a class="btn btn-light btn-md"  href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                         <i class="fas fa-sign-out-alt"></i>
                    </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
               <aside class="main-sidebar sidebar-dark-primary elevation-6" style="background-color:#0a5c54">
                <!-- Brand Logo -->
                <a href="{{ url('/') }}" class="brand-link"  style="background-color:#dee2e6; padding: .8125rem 0.8rem;">
                    <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image "
                        style="opacity: .8">
                    <span class="brand-text font-weight-dark" style="color:black">easy<b style="color:#148F77">POS</b></span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="/" class="{{ Request::path() === '/' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Inicio</p>
                                </a>
                            </li>
                            @can('administrador')
                            <li class="nav-item ">
                                <a href="{{url('usuarios')}}"
                                    class="{{ Request::path() === 'usuarios' ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Usuarios
                                        <?php  $users_count = DB::table('users')->count(); ?>
                                        <span class="right badge badge-danger">{{ $users_count ?? '0' }}</span>
                                    </p>
                                </a>
                            </li>
                            @endcan
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-box-open"></i>
                                    <p>Almacen<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                    <a href="{{url('categoria')}}"
                                            class="{{ Request::path() === 'categoria' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Categorias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="{{url('articulo')}}"
                                            class="{{ Request::path() === 'articulo' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Artículos</p>
                                        </a>
                                    </li>
                                </ul>
                             </li>
                             <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cart-arrow-down"></i>
                                    <p>Ventas<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                    <a href="{{url('cliente')}}"
                                            class="{{ Request::path() === 'cliente' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Clientes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="{{url('venta')}}"
                                            class="{{ Request::path() === 'venta' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ventas</p>
                                        </a>
                                    </li>
                                </ul>
                             </li>
                             <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-clipboard-list"></i>
                                    <p>Compras<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                    <a href="{{url('proveedor')}}"
                                            class="{{ Request::path() === 'proveedor' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Provedores</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="{{url('ingreso')}}"
                                            class="{{ Request::path() === 'ingreso' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ingresos</p>
                                        </a>
                                    </li>
                                </ul>
                             </li>

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header" style="padding: 5px">

                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <!-- NO QUITAR -->
                <strong>LyL Sistemas Informáticos
                    <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> 1.0
                    </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
    </div>
</body>

</html>

<script>
  @if(Session::has('success'))
   
  toastr.options.progressBar = true;
  toastr.options.positionClass = "toast-bottom-right";
      toastr.success("{{Session::get('success')}}")
  @endif
  @if(Session::has('warning'))
   
   toastr.options.progressBar = true;
   toastr.options.positionClass = "toast-bottom-right";
       toastr.success("{{Session::get('warning')}}")
   @endif

  
</script>