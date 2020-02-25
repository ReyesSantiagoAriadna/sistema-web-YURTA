{{--            CUADRO DE DIALOGO PARA ACTUALIZAR REGISTRO--}}
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn btn-danger btn-circle" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Record</h4>
                <br/>

            </div>

            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal">
                    @csrf
                    <label>Nombre</label>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons">merge_type</i></span>
                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="Nombre" id="razon_social" name="razon_social" required>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <div style="float:right;">
                            <button type="button" id="add_atrib" name="add_atrib" class="btn bg-cyan waves-effect">
                                <i class="material-icons">add</i>
                            </button>
                        </div>
                        <br/>
                        <br>
                        <br/>
                        <table class="tabla-atributos" id="table_atrib" style="width:100%" >
                            <thead>
                            <tr>
                                <th class="th-atrib">Atributo</th>
                                <th>Valor</th>
                            </tr>
                            </thead>
                        <tbody>
                                <tr class="tr-atrib">
                                    <td class="th-atrib" >
                                        <input name="atributos[]" id="atributos" type="text" class="form-control">
                                    </td>
                                    <td class="th-atrib" >
                                        <input name="valores[]" id="valores" type="number" class="form-control">
                                    </td>
                                </tr>
                         </tbody>
                    </table>
                    </div>
                    <br>
                    <br>
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
        $('#tabla-proveedores').dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        } );

        $('#add_atrib').click(function () {
            $('#table_atrib').find('tbody').append("<tr class=\"tr-atrib\">\n" +
                "                                    <td class=\"th-atrib\" >\n" +
                "                                        <input name=\"atributos[]\" id=\"atributos\" type=\"text\" class=\"form-control\">\n" +
                "                                    </td>\n" +
                "                                    <td class=\"th-atrib\" >\n" +
                "                                        <input name=\"valores[]\" id=\"valores\" type=\"number\" class=\"form-control\">\n" +
                "                                    </td>\n" +
                "                                </tr>");
        });

        $('#create_record').click(function(){
            $('.modal-title').text('Agregar Tipo de Obra');
            $('#action_button').val('Agregar');
            $('#action').val('Add');
            $('#form_result').html('');
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            var action_url = '';

            if($('#action').val() == 'Add'){
                action_url = "{{ route('tipo_obra.agregar') }}";
            }

            $.ajax({
                url: action_url,
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                success:function(data) {
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            });
        });
    } );
</script>
