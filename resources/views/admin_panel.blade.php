<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yurta App</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOoifiSc2LnrhQwCJLy7xuaYgEo3xAE5s&libraries=places"
            type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <style>
        #map-canvas{
            width: 100%;
            height: 450px;
        }
    </style>
    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Morris Css -->
    <link href="../../plugins/morrisjs/morris.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- *******************  SCRIPT  ******************** -->
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>
    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    <script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>


</head>

<body class="theme-red">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{route('home')}}">YURTA APP</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                <!-- #END# Call Search -->
                <!-- Notifications -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">notifications</i>
                        @if(auth()->user()->unreadNotifications->count())
                            <span class="label-count">{{auth()->user()->unreadNotifications->count()}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">NOTIFICACIONES</li>
                        <li class="body">
                            <ul class="menu">
                                <li>
                                    <a href="{{route('markAsRead')}}">
                                        <div class="icon-circle bg-light-green">
                                            <i class="material-icons">check_circle</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>Marcar como leidas</h4>
                                            <p>
                                                <i class="material-icons"></i>
                                            </p>
                                        </div>
                                    </a>
                                </li>


                                {{--<li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-cyan">
                                            <i class="material-icons">add_shopping_cart</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>4 sales made</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> 22 mins ago
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" >
                                        <div class="icon-circle bg-red">
                                            <i class="material-icons">delete_forever</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4><b>Nancy Doe</b> deleted account</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> 3 hours ago
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-orange">
                                            <i class="material-icons">mode_edit</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4><b>Nancy</b> changed name</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> 2 hours ago
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-blue-grey">
                                            <i class="material-icons">comment</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4><b>John</b> commented your post</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> 4 hours ago
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-light-green">
                                            <i class="material-icons">cached</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4><b>John</b> updated status</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> 3 hours ago
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="icon-circle bg-purple">
                                            <i class="material-icons">settings</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>Settings updated</h4>
                                            <p>
                                                <i class="material-icons">access_time</i> Yesterday
                                            </p>
                                        </div>
                                    </a>
                                </li>--}}
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="javascript:void(0);">Ver todas las notificaciones</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# Notifications -->
                <!-- Tasks -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">flag</i>
                        <span class="label-count">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">TASKS</li>
                        <li class="body">
                            <ul class="menu tasks">
                                <li>
                                    <a href="javascript:void(0);">
                                        <h4>
                                            Footer display issue
                                            <small>32%</small>
                                        </h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <h4>
                                            Make new buttons
                                            <small>45%</small>
                                        </h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <h4>
                                            Create new dashboard
                                            <small>54%</small>
                                        </h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <h4>
                                            Solve transition issue
                                            <small>65%</small>
                                        </h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <h4>
                                            Answer GitHub questions
                                            <small>92%</small>
                                        </h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="javascript:void(0);">View All Tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# Tasks -->
                <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="../../images/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                @guest
                @else
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} </div>
                    <div class="email">{{ Auth::user()->email }}</div>
                @endguest

                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{route('perfil')}}"><i class="material-icons">person</i>Perfil</a></li>
                        <li role="separator" class="divider"></li>

                        <li role="separator" class="divider"></li>

                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i>Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>




                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MENÚ</li>
                <li class="{{ $nav_inicio or ''  }}">
                    <a href="{{route('home')}}" >
                        <i class="material-icons ">home</i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="{{ $nav_empleados or ''  }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons ">account_circle</i>
                        <span>Empleados</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ $nav_empleados_agregar or ''  }}">
                            <a href="{{route('usuarios.add')}}">Nuevo</a>
                        </li>

                        <li class="{{ $nav_empleados_mostrar or ''  }}">
                            <a  href="{{route('usuarios')}}">Mostrar</a>
                        </li>
                       
                    </ul>
                </li>
                <li class="{{ $nav_obras or ''  }}">
                    <a href="javascript:void(0);" class=" menu-toggle ">
                        <i class="material-icons">local_convenience_store</i>
                        <span>Obras</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ $nav_obras_agregar or ''  }}">
                            <a href="{{route('obra.agregar')}}">Nuevo</a>
                        </li>
                        <li class="{{ $nav_obras_mostrar or ''  }}">
                            <a href="{{route('obras')}}" >Mostrar</a>
                            <ul class="ml-menu">
                                <li class="{{ $nav_obras_mostrar_detalle or ''  }}">
                                    <a>Detalle</a>
                                </li>
                                <li class="{{ $nav_obras_mostrar_agregar_material or ''  }}">
                                   <a>Agregar material</a>
                                </li>
                            </ul>
                        </li>
                        

                        <li class="{{ $nav_obras_presupuesto or ''  }}">
                            <a href="{{route('obra.presupuesto')}}">Presupuesto</a>
                        </li>
                        <li class="{{ $nav_obras_tipos or ''  }}">
                            <a href="{{route('tipo_obras.mostrar')}}">Tipos</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ $nav_materiales or ''  }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons ">ev_station</i>
                        <span>Materiales</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ $nav_materiales_agregar or ''  }}">
                            <a href="{{route('material_agregar')}}">Nuevo</a>
                        </li>
                        <li class="{{ $nav_materiales_mostrar or ''  }}">
                            <a href="{{route('materiales')}}">Mostrar</a>
                        </li>
                        <li class="{{ $nav_materiales_mostrar_tipos or ''  }}">
                            <a href="{{route('tipo_materiales')}}">Tipo de material</a>
                        </li>
                        <li class="{{ $nav_materiales_mostrar_unidades or ''  }}">
                            <a href="{{route('unidad_materiales')}}">Unidad de material</a>
                        </li>
                        
                    </ul>
                </li>

                <li class="{{ $nav_proveedores or ''  }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons ">people</i>
                        <span>Proveedores</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ $nav_proveedores_agregar or ''  }}">
                            <a href="{{route('proveedor>agregar')}}">Nuevo</a>
                        </li>
                        <li class="{{ $nav_proveedores_mostrar or ''  }}">
                            <a href="{{route('proveedores')}}">Mostrar</a>
                        </li>
                        
                    </ul>
                </li>



                <li class="{{ $nav_pedidos or ''  }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons ">local_shipping</i>
                        <span>Pedidos</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ $nav_pedidos_mostrar or ''  }}">
                            <a href="{{route('pedidos')}}">Mostrar</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2020 <a href="javascript:void(0);">Yurta App</a>.
            </div>

        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#settings" data-toggle="tab">CONFIGURACIÓN</a></li>
        </ul>
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane fade in active in active" id="settings">
                <div class="demo-settings">

                    <p>CONFIGURACIONES DEL SISTEMA</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notificaciones</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>CONFIGURACIONES DE CUENTA</p>
                    <ul class="setting-list">
                        <li>
                            <span>Desconectar</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Permiso de ubicación</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">

        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @yield('contenido')
            </div>
        </div>
        <!-- #END# Basic Examples -->
        <!-- Exportable Table -->
        <!-- #END# Exportable Table -->
    </div>
</section>


@yield('scrips')
</body>

</html>
