<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>Yurta App</title>
    <!-- Bootstrap Core CSS -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
{{--    <link href="css/animate.css" rel="stylesheet">--}}
    <link href="/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="/css/colors/default.css" id="theme" rel="stylesheet">
    <style>
        #map-canvas{
            width: 550px;
            height: 450px;
        }
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOoifiSc2LnrhQwCJLy7xuaYgEo3xAE5s&libraries=places"
        type="text/javascript"></script>
</head>
<body class="fix-header">
<div class="preloader">
    {{--<svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>--}}
</div>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <!-- Logo -->
                <a class="logo" href="{{route('home')}}">
                    <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><img src="/plugins/images/logo_white.png" alt="home"
                                                          class="dark-logo" />
                        <!--This is light logo icon--><img src="/plugins/images/logo_white.png" alt="home"
                                                           class="light-logo" />
                    </b>
                    <!-- Logo text image you can use text also --><span class="hidden-xs">
                            <!--This is dark logo text--><img src="/plugins/images/logo_letter.png" alt="home"
                                                              class="dark-logo" />
                        <!--This is light logo text--><img src="/plugins/images/logo_letter.png" alt="home"
                                                           class="light-logo" />
                        </span> </a>
            </div>
            <!-- /Logo -->
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li>
                    <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg"
                       href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                </li>

                <li>
                    @guest
                    @else
                        <a class="profile-pic" href="#"> <img src="/plugins/images/users/varun.jpg" alt="user-img"
                                                              width="36" class="img-circle"><b class="hidden-xs">{{ Auth::user()->name }} </b></a>

                    @endguest
                </li>
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav slimscrollsidebar">
            <div class="sidebar-head">
                <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span
                            class="hide-menu">Menu</span></h3>
            </div>
            <ul class="nav" id="side-menu">
                <li style="padding: 70px 0 0;">
                    <a href="{{route('home')}}" class="waves-effect"><i class="fa fa-clock-o fa-fw"
                                                                     aria-hidden="true"></i>Dashboard</a>
                </li>
                <li>
                    <a href="{{route('usuarios')}}" class="waves-effect"><i class="fa fa-user fa-fw"
                                                                   aria-hidden="true"></i>Usuarios</a>
                </li>
                <li>
                    <a href="{{route('proveedores')}}" class="waves-effect"><i class="fa fa-truck fa-fw"
                                                                       aria-hidden="true"></i>Proveedores</a>
                </li>
                <li>
                    <a href="{{route('material')}}" class="waves-effect"><i class="fa fa-fw"><i class="fas fa-boxes"
                                                                                                          aria-hidden="true"></i></i>Materiales</a>
                </li>
                <li>
                    <a href="{{route('obras')}}" class="waves-effect"><i class="fas fa-building fa-fw"
                                                                      aria-hidden="true"></i>Obras</a>
                </li>
                <li>
                    <a href="{{route('pedidos')}}" class="waves-effect"><i class="fa fa-fw"><i class="fas fa-truck-loading"
                                                                                     aria-hidden="true"></i></i>Pedidos</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-in fa-fw"></i>Salir
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>


            </ul>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">{{Route :: currentRouteName ()}}</h4>

                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}">Dashboard</a></li>
                        <li class="active">{{Route :: currentRouteName ()}}</li>
                    </ol>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
        @yield('contenido')
        <footer class="footer text-center"> 2020 &copy; Yurta App </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="/js/custom.min.js"></script>
</body>

</html>