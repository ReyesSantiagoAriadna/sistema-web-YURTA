<?php $nav_inicio = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="block-header">
                <h2>TABLERO</h2>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-blue hover-expand-effect">
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
                        <i class="material-icons">local_convenience_store</i>
                    </div>
                    <div class="content">
                        <div class="text">OBRAS</div>
                        <div class="number count-to" data-from="0" data-to="{{\App\Http\Controllers\PedidosController::countPedidos()}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">ev_station</i>
                    </div>
                    <div class="content">
                        <div class="text">MATERIALES</div>
                        <div class="number count-to" data-from="0" data-to="{{\App\Http\Controllers\MaterialController::countMateriales()}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">account_circle</i>
                    </div>
                    <div class="content">
                        <div class="text">EMPLEADOS</div>
                        <div class="number count-to" data-from="0" data-to="{{\App\Http\Controllers\PedidosController::countUsuarios()}}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2>OBRAS</h2>
                        </div>

                    </div>

                </div>
                <div class="body">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"></span>
                        <div class="form-line">
                            <div  id="map-canvas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>
    <script src="js/pages/index.js"></script>
    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    <script>
        function initMap() {
            var map;
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: 'roadmap',
                center:{
                    lat:17.0731842,
                    lng:-96.7265889
                },
                zoom:7
            };

            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
            map.setTilt(50);
            var infoWindow = new google.maps.InfoWindow(), marker, i;

            $.ajax({
                url :"/obras_ubicacion",
                dataType:"json",
                success:function(data) {
                    data.result.forEach( function(valor, indice) {
                        var obra=[];
                        obra.push(valor.descripcion);
                        obra.push(valor.lat);
                        obra.push(valor.lng);
                        //markers.push(obra);
                        var inf = ['<div class="info_content">' +
                        '<h3>#'+valor.id +' Dependencia: '+valor.dependencia+'</h3>' +
                        '<p>Descripción: '+valor.descripcion+'</p>' +
                        '<p>Tipo de obra: '+valor.tipo_obra+'</p>' +
                        '</div>'];
                       /// infoWindowContent.push(inf);
                        var position = new google.maps.LatLng(valor.lat,valor.lng);
                        bounds.extend(position);
                        marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            title:valor.descripcion
                        });
                        // Add info window to marker
                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                infoWindow.setContent(inf[0]);
                                infoWindow.open(map, marker);
                            }
                        })(marker, i));
                        // Center the map to fit all markers on the screen
                        map.fitBounds(bounds);
                    });
            }});
            // Set zoom level
            var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                this.setZoom(14);
                google.maps.event.removeListener(boundsListener);
            });
        }
        // Load initialize function
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
@endsection
