<?php $nav_obras = 'active'; ?>
<?php $nav_obras_agregar = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="card">
        <div class="header">
            <h2> Obras</h2>
            <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);">Action</a></li>
                        <li><a href="javascript:void(0);">Another action</a></li>
                        <li><a href="javascript:void(0);">Something else here</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="body">
            <ol class="breadcrumb breadcrumb-col-orange">
                <li><a href="javascript:void(0);"><i class="material-icons">local_convenience_store</i> Obras</a></li>
                <li class="active"><i class="material-icons">add_circle</i> Nuevo</li>
            </ol>
            <form method="POST" action="{{ route('obra>add') }}">
                @csrf
                <h2 class="card-inside-title">Datos de la obra</h2>
                <label>Tipo de obra</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">merge_type</i>
                    </span>
                    <div class="form-line">
                        <select name="tipo_obra" class="form-control" id="tipo_obra" required autofocus>
                            <option value="">Seleccione el tipo de obra</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{$tipo['id']}}">{{$tipo['descripcion']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <label>Fecha de inicio</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-line">
                        <input  name="fech_ini" id="fech_ini" dtype="text" class="  datepicker form-control" placeholder="Fecha de inicio" required>
                    </div>
                </div>



                <label>Descripción</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">description</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Descripción" id="descripcion" name="descripcion" required>
                    </div>
                </div>
                <label>Dependencia</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">store_mall_directory</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Dependencia" id="dependencia"
                               name="dependencia" required>
                    </div>
                </div>
                <label>Residente de obra</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">account_circle</i>
                    </span>
                    <div class="form-line">
                        <select name="encargado" class="form-control" id="encargado" required autofocus>
                            <option value="">Seleccione al residente de obra</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{$usuario['id']}}">{{$usuario['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <label>Ubicación</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">search</i>
                    </span>
                    <div class="form-line">
                        <input type="text" id="searchmap"  class="form-control" placeholder="buscar">
                    </div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon"></span>
                    <div class="form-line">
                        <div  id="map-canvas"></div>
                    </div>
                </div>

                <input name="lat"  type="hidden"  class="form-control input-group-sm" id="lat" value="">
                <input name="lng" type="hidden" class="form-control input-group-sm" id="lng" value="">
                <button class="btn btn-primary waves-effect" type="submit">REGISTRAR</button>
            </form>
        </div>
    </div>




    <script>
        var map= new google.maps.Map(document.getElementById('map-canvas'),{
            center:{
                lat:17.0731842,
                lng:-96.7265889
            },
            zoom:15
        });
        var marker = new google.maps.Marker({
            position:{
                lat:17.0731842,
                lng:-96.7265889
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
    </script>
    <!-- Autosize Plugin Js -->
    <script src="plugins/autosize/autosize.js"></script>
    <!-- Moment Plugin Js -->
    <script src="plugins/momentjs/moment.js"></script>
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>

    <script>
        $('#fech_ini').bootstrapMaterialDatePicker({ format: 'YYYY/MM/DD',  time: false,});
    </script>

@endsection