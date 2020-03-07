{{--            CUADRO DE DIALOGO PARA ACTUALIZAR REGISTRO--}}
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn btn-danger btn-circle" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Record</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal">
                    @csrf
                    <label>Descripción</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">description</i></span>
                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="Descripción" id="descripcion" name="descripcion" required>
                        </div>
                    </div>

                    <label>Fecha de inicio</label>
                    <div class="input-group input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                    </span>
                        <div class="form-line">
                            <input  name="fech_ini" id="fech_ini" dtype="text" class="  datepicker form-control" placeholder="Fecha de inicio" required>
                        </div>
                    </div>

                    <label>Fecha de termino</label>
                    <div class="input-group input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                    </span>
                        <div class="form-line">
                            <input  name="fech_fin" id="fech_fin" dtype="text" class="  datepicker form-control" placeholder="Fecha de inicio" required>
                        </div>
                    </div>

                    <label>Dependencia</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">store_mall_directory</i></span>
                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="Dependencia" id="dependencia" name="dependencia" required>
                        </div>
                    </div>

                    <label>Residente</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">people</i></span>
                        <div class="form-line">
                            <select name="encargado" class="form-control"  id="encargado" required autofocus>
                            </select>
                        </div>
                    </div>

                    <label>Tipo</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">merge_type</i></span>
                        <div class="form-line">
                            <select name="tipo" class="form-control"  id="tipo" required autofocus>
                            </select>
                        </div>
                    </div>

                    <label>Ubicación</label>
                    <div class="input-group input-group">
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


                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Editar" />
                    </div>



                </form>
            </div>
        </div>
    </div>
</div>

{{--            CUADRO DE DIALOGO PARA CONFIRMAR ELIMINACION DEL REGISTRO--}}
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmación</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">¿Estas seguro de eliminar este registro?</h4>
            </div>
            <div class="modal-footer">

                <button type="button" name="ok_button" id="ok_button"  data-token="{{ csrf_token() }}" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    ﻿$(document).ready( function() {
        $('#tabla-obras').dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        } );


        var id;

         
//obtencion de registro a editar
        $(document).on('click', '.edit', function(){
            id = $(this).attr('id');            
            $('#form_result').html('');
            $.ajax({
                url :"/edit_obra/"+id,
                dataType:"json",
                success:function(data) {
                    $('#descripcion').val(data.result.descripcion);
                    $('#fech_ini').val(data.result.fech_ini);
                    $('#fech_fin').val(data.result.fech_fin);
                    $('#dependencia').val(data.result.dependencia);
                    $('#lat').val(data.result.lat);
                    $('#lng').val(data.result.lng);

                    var encargado = document.getElementById("enc").value;
                    var tipo_obra = document.getElementById("tipo").value;
 

                    $.get('residentes',function (encargados) {
                        $('#encargado').empty();
                        $.each(encargados,function(key, registro) {
                            $('#encargado').append("<option value='" + registro.id + "'" + (encargado == registro.id ? 'selected' : '') + ">" + registro.name +"</option>");
                        });
                    });


                    $.get('tipos',function (tipos) {
                        $('#tipo').empty();
                        console.log("tipos",tipos);
                        $.each(tipos,function(key, registro) {
                            $('#tipo').append("<option value='" + registro.id + "'" + (tipo_obra == registro.id ? 'selected' : '') + ">" + registro.descripcion +"</option>");
                        });
                    });


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


                    $('#hidden_id').val(id);
                    $('.modal-title').text('Editar Registro');
                    $('#action_button').val('Editar');
                    $('#action').val('Editar');
                    $('#formModal').modal('show');
                }
            })
        });
        //actualizacion de registro
        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == "Editar") {
                $.ajax({
                    url:"/update_obra",
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType:"json",
                    success:function(data) {
                        var html = '';
                        if(data.errors){
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            $('#tabla').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            }
        });


        var user_id ;
//confirmacion para eliminar
        $(document).on('click', '.delete', function(){
            user_id = $(this).attr('id');
            $('.modal-title').text('Eliminar Registro');
            $('#confirmModal').modal('show');
        });

//eliminacion de registro
        $('#ok_button').click(function(){
            var token = $(this).data('token');
            $.ajax({
                url:"/eliminar_obra/"+user_id,
                type: 'post',
                data: {_method: 'delete', _token :token},
                beforeSend:function(){
                    $('#ok_button').text('Eliminando...');
                },
                success:function(data){
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#tablauser').DataTable().ajax.reload();
                        alert('Registro Eliminado');
                    }, 200);
                }
            })
        });


    } );


</script>
<script>

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
