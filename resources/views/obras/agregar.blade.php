@extends('panel')
@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    @if(session('mensaje'))
                        <div class="alert alert-success">
                            {{session('mensaje')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('obra>add') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de obra') }}</label>

                            <div class="col-md-6">
                                <select name="tipo" class="form-control" id="tipo" required autofocus>
                                    <option value="">Seleccione el Tipo de obra</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{$tipo['id']}}">{{$tipo['descripcion']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tipo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion') }}" required autofocus>

                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fech_ini" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de inicio') }}</label>

                            <div class="col-md-6">
                                <input id="fech_ini" type="date" class="form-control{{ $errors->has('fech_ini') ? ' is-invalid' : '' }}" name="fech_ini" value="{{ old('fech_ini') }}" required>

                                @if ($errors->has('fech_ini'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fech_ini') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dependencia" class="col-md-4 col-form-label text-md-right">{{ __('Dependencia') }}</label>

                            <div class="col-md-6">
                                <input id="dependencia" type="text" class="form-control{{ $errors->has('dependencia') ? ' is-invalid' : '' }}" name="dependencia" required>

                                @if ($errors->has('dependencia'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dependencia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="encargado" class="col-md-4 col-form-label text-md-right">{{ __('Residente') }}</label>

                            <div class="col-md-6">
                                <select name="encargado" class="form-control" id="select-encargado" required autofocus>
                                    <option value="">Seleccione el residente</option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{$usuario['id']}}">{{$usuario['name']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('encargado'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('encargado') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="ubicacion" class="col-md-4 col-form-label text-md-right">{{ __('Ubicación') }}</label>
                        </div>
                        <div class="form-group row m-auto">

                                <div class="form-group">
                                    <input type="text" id="searchmap" placeholder="buscar">
                                    <div id="map-canvas"></div>
                                </div>
                                <div class="form-group">
                                    <label>Lat</label>
                                    <input name="lat" type="text" class="form-control input-group-sm" id="lat" value="">
                                </div>
                                <div class="form-group">
                                    <input name="lng" type="text" class="form-control input-group-sm" id="lng" value="">
                                </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Agregar') }}
                                </button>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
