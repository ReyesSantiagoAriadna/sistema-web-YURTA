<?php $nav_obras = 'active'; ?>
<?php $nav_obras_presupuesto= 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="block-header">
        <h2> OBRAS</h2>
    </div>
    <div class="card">
        <div class="header">
            <h2>
            </h2>
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
            <form method="POST">
                @csrf
                <ol class="breadcrumb breadcrumb-col-orange">
                    <li><a href="javascript:void(0);"><i class="material-icons">local_convenience_store</i> Obras</a></li>
                    <li ><i class="material-icons">visibility</i> Mostrar</li>
                    <li class="active"><i class="material-icons">add_box</i> Agregar Material</li>
                    <div style="float:right;">
                        <button class="btn btn-primary" type="submit">
                            Aceptar
                        </button>
                        <button class="btn btn-primary" id="add_material" type="button">
                            Agregar
                        </button>
                    </div>
                </ol>
                <div class="input-group input-group" style="width: 50%">
                    <span class="input-group-addon">
                        <i class="material-icons"></i>
                    </span>
                    <div class="form-line">
                        <select name="proveedor" class="form-control" id="proveedor" required autofocus>
                            <option value="">Seleccione la obra</option>
                            @foreach ($obras as $obra)
                                <option value="{{$obra['id']}}">{{$obra['descripcion']}}</option>
                            @endforeach
                        </select>
                        <div style="float:right;">
                            Total: $<input id="total" value="0" name="total" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                    <div class="table-responsive">
                        <table id="tabla-materiales" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Descripción</th>
                                <th>Unidad</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Precio compra</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Descripción</th>
                                <th>Unidad</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Precio compra</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

            </form>
        </div>
    </div>

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
                    <label>Buscar</label>
                    <input list="materiales" class="form-control">
                    <datalist id="materiales" >
                        @foreach ($materiales as $material)
                            <option value="{{$material['descripcion']}}" id="{{$material->id}}"/>
                        @endforeach
                    </datalist>
                    <br>
                    <br>
                    <div class="input-group input-group">
                        <span class="input-group-addon"><i class="material-icons"></i></span>
                        <div class="form-line" style="width: 40%;float:left;">
                            <input type="text" class="form-control" placeholder="Nombre" id="razon_social" name="razon_social" required>
                        </div>


                        <div class="form-line" style="width: 40%; float:right;">
                            <input type="text" class="form-control" placeholder="Nombre" id="razon_social" name="razon_social" required>
                        </div>
                    </div>

                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Editar" />
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

        $(document).ready( function() {
            $('#tabla-materiales').dataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            } );
        });

        $('#add_material').click(function(){
            $('.modal-title').text('Agregar Material');
            $('#action_button').val('Agregar');
            $('#action').val('Add');
            $('#form_result').html('');
            $('#formModal').modal('show');
        });
    </script>
@endsection



{{--
$(function(){
//keyup change paste keydown
$('input[name="input-1"]').on('change paste', function(){
var $this = $(this);


var price =  parseFloat($this.attr('id')) ;
var cantidad = $this.val();
var subtotal = cantidad * price;
console.log(price)
console.log(cantidad);
console.log(subtotal); // ID; for referencing

var total = parseFloat(document.getElementById("total").value);

$('#total').empty();
$('#total').val(total+subtotal);
});

});--}}
