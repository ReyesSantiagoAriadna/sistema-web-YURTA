﻿$(document).ready( function() {
    $('#tabla-empleado').dataTable({
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
            url :"/edit_user/"+id,
            dataType:"json",
            success:function(data) {
                $('#name').val(data.result.name);
                $('#email').val(data.result.email);
                $('#telefono').val(data.result.telefono);
                $('#puesto').val(data.result.puesto);
                $('#hidden_id').val(id);
                $('.modal-title').text('Editar Registro');
                $('#action_button').val('Editar');
                $('#action').val('Editar');
                $('#formModal').modal('show');
            }
        })
    });
//actualizar registro

    $('#update').click(function(){
        var token = $(this).data('token');
        $.ajax({
            url:"/editar_usuario/"+id,
            type: 'post',
            data: {_method: 'put', _token :token},
            success:function(data){
                setTimeout(function(){
                    $('#confirmModal').modal('hide');
                    $('#tabla').DataTable().ajax.reload();
                    alert('Registro actualizado');
                }, 200);
            }
        })
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
            url:"/eliminar_usuario/"+user_id,
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
    //actualizacion de registro
    $('#sample_form').on('submit', function(event){
        event.preventDefault();
        if($('#action').val() == "Editar") {
            $.ajax({
                url:"/update_user",
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

} );

