<?php $nav_inicio = 'active'; ?>
@extends('admin_panel')
@section('contenido')

    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">local_shipping</i>
                </div>
                <div class="content">
                    <div class="text">PEDIDOS</div>
                    <div class="number count-to" data-from="0" data-to="{{\App\Http\Controllers\PedidosController::countPedidos()}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">local_shipping</i>
                </div>
                <div class="content">
                    <div class="text">OBRAS</div>
                    <div class="number count-to" data-from="0" data-to="{{\App\Http\Controllers\PedidosController::countPedidos()}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    <div>






   {{-- <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>
    <script src="js/pages/index.js"></script>
    <!-- Morris Plugin Js -->
    <script src="../../plugins/raphael/raphael.min.js"></script>
    <script src="../../plugins/morrisjs/morris.js"></script>
    <script src="../../js/pages/charts/morris.js"></script>

        <!-- Chart Plugins Js -->
        <script src="../../plugins/chartjs/Chart.bundle.js"></script>

        <!-- Custom Js -->
        <script src="../../js/admin.js"></script>
        <script src="../../js/pages/charts/chartjs.js"></script>

        <!-- Demo Js -->
        <script src="../../js/demo.js"></script>
--}}
        <!-- Jquery CountTo Plugin Js -->
        <script src="plugins/jquery-countto/jquery.countTo.js"></script>
        <!-- Morris Plugin Js -->
        <script src="plugins/raphael/raphael.min.js"></script>
        <script src="plugins/morrisjs/morris.js"></script>
        <!-- ChartJs -->
        <script src="plugins/chartjs/Chart.bundle.js"></script>
        <!-- Flot Charts Plugin Js -->
        <script src="plugins/flot-charts/jquery.flot.js"></script>
        <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
        <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
        <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
        <script src="plugins/flot-charts/jquery.flot.time.js"></script>
        <!-- Sparkline Chart Plugin Js -->
        <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>
        <script src="js/pages/index.js"></script>
        <!-- Demo Js -->
        <script src="js/demo.js"></script>


@endsection
