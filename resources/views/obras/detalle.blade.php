<?php $nav_obras = 'active'; ?>
<?php $nav_obras_mostrar = 'active'; ?>
<?php $nav_obras_mostrar_detalle = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-3">
                <div class="card profile-card">
                    <div class="profile-header"></div>
                    <div class="profile-body">
                        <div class="image-area">
                            <img src="../../images/grua.png" alt="AdminBSB - Profile Image" />
                        </div>
                        <div class="content-area">
                            <h3>{{$obra->descripcion}}</h3>
                            <p>{{$obra->dependencia}}</p>
                            <p></p>
                        </div>
                        <div class="profile-footer">
                            <ul>
                                <li>
                                    <span>Fecha de inicio</span>
                                    <span>{{$obra->fech_ini}}</span>
                                </li>
                                <li>
                                    <span>Dependencia</span>
                                    <br>
                                    <span style="float:right">{{$obra->dependencia}}</span> 
                                    <br>
                                </li>
                                
                                <li>
                                    <span>Residente</span>
                                    @foreach ($data as $item)
                                      <span>{{$item->name}}</span> 
                                    @endforeach                                  
                                </li>
                                
                            </ul>
                        </div>
                    </div>

                </div>


            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="card">
                    <div class="body">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Ubicación</a></li>
                                <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Materiales</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_settings">
                                    <form class="form-horizontal" >
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon"></span>
                                            <div class="form-line">
                                                <div  id="map-canvas"></div>
                                            </div>
                                        </div>
                                        <input id="lat" name="lat" type="hidden" value="{{$obra->lat}}">
                                        <input id="lng" name="lng" type="hidden" value="{{$obra->lng}}">
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                    <form class="form-horizontal">

                                        <div class="table-responsive">
                                            <table id="tabla-material" class="display " style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>Descripción</th>
                                                    <th>Existencias</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>Descripción</th>
                                                    <th>Existencias</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($materiales as $item)
                                                    <tr>
                                                        <td>{{$item->descripcion}}</td>
                                                        <td>{{$item->cantidad}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        ﻿$(document).ready( function() {

            $('#tabla-material').dataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            } );


            ///MAPA
            var _lat = document.getElementById("lat").value;
            var _lng = document.getElementById("lng").value;

            //console.log("lat",_lat);

            var map= new google.maps.Map(document.getElementById('map-canvas'),{
                center:{
                    lat:parseFloat(document.getElementById("lat").value),
                    lng:parseFloat(document.getElementById("lng").value),
                },
                zoom:15
            });

            var marker = new google.maps.Marker({
                position:{
                    lat:parseFloat(document.getElementById("lat").value),
                    lng:parseFloat(document.getElementById("lng").value),
                },
                map: map,
                draggable:true
            });

            var searchBox= new google.maps.places.SearchBox(document.getElementById('searchmap'));

            google.maps.event.addListener(searchBox,'places_changed',function () {
                var places=searchBox.getPlaces();
                var bounds = new google.maps.LatLngBounds();
                var i,place;

                for(i=0; place=places[i];i++){
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location);
                }

                map.fitBounds(bounds);
                map.setZoom(15);

            });
            google.maps.event.addListener(marker,'position_changed',function () {
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                $('#lat').val(lat);
                $('#lng').val(lng);

            });
        })
    </script>
@endsection
