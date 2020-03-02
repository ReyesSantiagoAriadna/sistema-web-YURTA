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
                      
                    <label>Marca</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">branding_watermark</i></span>
                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="Marca" id="marca" name="marca" required>
                        </div>
                    </div>

                    
                    <label>Precio de compra</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">monetization_on</i></span>
                        <div class="form-line">
                            <input type="number" class="form-control" min="0" placeholder="Precio de compra" id="precio_unitario" name="precio_unitario" required>
                        </div>
                    </div>

                    <label>Existencias</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                        <div class="form-line">
                            <input type="number" class="form-control" min="0" placeholder="Existencias" id="existencias" name="existencias" required>
                        </div>
                    </div>

                    <label>Stock</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                        <div class="form-line">
                            <input type="number" class="form-control" min="1" placeholder="Cantidad minima" id="stock" name="stock" required>
                        </div>
                    </div>

                    <label>Unidad</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">flag</i></span>
                        <div class="form-line">
                            <select name="unidades" class="form-control"  id="unidad" required autofocus>
                            </select>
                        </div>
                    </div>

                    <label>Proveedor</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">people</i></span>
                        <div class="form-line">
                            <select name="proveedor" class="form-control"  id="proveedores" required autofocus>
                            </select>
                        </div>
                    </div>

                    <label>Tipo</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">people</i></span>
                        <div class="form-line">
                            <select name="tipos" class="form-control"  id="tipo" required autofocus>
                            </select>
                        </div>
                    </div>

                   



                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="proveedor_id" id="proveedor_id" />
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
        $('#tabla-materiales').dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        } );

        var id;
        var provider;
//obtencion de registro a editar
        $(document).on('click', '.edit', function(){
            id = $(this).attr('id');
            provider = $(this).attr('value');
            $('#form_result').html('');
            $.ajax({
                url :"/edit_material/"+id,
                dataType:"json",
                success:function(data) {
                    $('#descripcion').val(data.result.descripcion); 
                    $('#marca').val(data.result.marca);
                    $('#existencias').val(data.result.existencias);
                    $('#stock').val(data.result.cantidad_minima);
                    $('#precio_unitario').val(data.result.precio_unitario);

                    //valores del obejto a editar
                    var tipo =  document.getElementById("tipo").value;
                    var unidad = document.getElementById("unidad").value;

                    // window.alert(provider);
                    //obtener los proveedores a travez de ajax
                    $.get('proveedores',function (proveedores) {
                        $('#proveedores').empty();
                        $.each(proveedores,function(key, registro) {
                            $('#proveedores').append("<option value='" + registro.id + "'" + (provider == registro.id ? 'selected' : '') + ">" + registro.razon_social +"</option>");
                        });
                    });

                    $.get('tipos_materiales',function (tipos_materiales) {
                            console.log("tipos",tipos_materiales);
                        $.each(tipos_materiales,function(key, registro) {
                            $('#tipo').append("<option value='" + registro.id + "'" + (tipo == registro.id ? 'selected' : '') + ">" + registro.descripcion +"</option>");
                        });
                    });

                    $.get('unidades_materiales',function (unidades_materiales) {
                            console.log("unidades",unidades_materiales);
                        $.each(unidades_materiales,function(key, registro) {
                            $('#unidad').append("<option value='" + registro.id + "'" + (unidad == registro.id ? 'selected' : '') + ">" + registro.descripcion +"</option>");
                        });
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
                    url:"/update_material",
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
                url:"/eliminar_material/"+user_id,
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