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
    <script src="https:////cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"defer></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
   
   
   
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css" rel="stylesheet">
   
    
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

                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
               
                    </li>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                    <a class="btn btn-outline-dark"  href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                         Salir
                    </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-6">
                <!-- Brand Logo -->
                <a href="{{ url('/') }}" class="brand-link">
                    <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image "
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">easy<b style="color:#48b1c0">POS</b></span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        
                        <div class="info">
                            <a href="#" class="d-block">
                                @guest
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                @else
                                <div class="image">
                       
                               <img  src="{{asset('imagenes/'.Auth::user()->imagen)}}" class="img-circle elevation-2" alt="User Image">
                                
                                </div>
                                
                                {{ Auth::user()->name }}
                                
                               

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>

                                @endguest
                            </a>
                        </div>
                    </div>

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
                            <li class="nav-item">
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
                                    <a href="{{url('ventas')}}"
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
                <div class="content-header">

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