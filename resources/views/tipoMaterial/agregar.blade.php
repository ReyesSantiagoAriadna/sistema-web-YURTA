<div id="formModal" class="modal fade" role="dialog">
    @if ( session('mensaje') )
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn btn-danger btn-circle" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar Tipo de Material</h4>
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
                              

                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="proveedor_id" id="proveedor_id" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Aceptar" />
                    </div>
                </form>
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

        $('#add_data').click(function(){
                $('#formModal').modal('show'); 
                $('#form_result').html('');
                $('#button_action').val('insert');
                $('#action').val('Add');
            });
            
        
            $('#sample_form').on('submit', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
                $.ajax({
                    url:"{{route('tipo_material_agregar')}}",
                    method:"POST",
                    data: form_data, 
                    dataType:"json",
                    success:function(data) {
                        var error_html = '';
                    if(data.errors){
                            html= '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>'+ data.errors[count] + '</p>';
                            }
                            html += '</div>'
                        }
                        else
                        { 
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                                $('#sample_form')[0].reset();
                                $('#user_tabla').DataTable().ajax.reload();
                               
                        }
                        $('#form_result').html(html);
                    }
                }); 
        });  



    } );    
</script>  