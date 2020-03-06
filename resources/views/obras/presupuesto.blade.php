<?php $nav_obras = 'active'; ?>
<?php $nav_obras_presupuesto= 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="block-header">
         </div>
    <div class="card">
        <div class="header">
            <h2>
                PRESUPUESTO
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
            <form method="POST" action="{{ route('calcular_presupuestro') }}">
                @csrf
                
                <ol class="breadcrumb breadcrumb-bg-orange">
                    <li style =  "font-size: 18px"><a href="javascript:void(0);"><i class="material-icons">local_convenience_store</i> Obras</a></li> 
                    <li style =  "font-size: 18px" class="active"><i class="material-icons">playlist_add_check</i>Presupuesto</li>
                    
                </ol> 
                

                <label></label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">streetview</i>
                    </span>
                    <div class="form-line">
                        <select name="proveedor" class="form-control" id="proveedor" required autofocus>
                            <option value="">Seleccione la obra</option>
                            @foreach ($obras as $obra)
                                <option value="{{$obra['id']}}">{{$obra['descripcion']}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>

                
                        
                <label>Longitud</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">remove</i>
                    </span>
                    <div class="form-line">
                        <input type="number" class="form-control" placeholder="Longitud mts" id="datos"
                               name="datos[]" step="0.01" min="0" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>

                <label>Ancho</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">space_bar</i>
                    </span>
                    <div class="form-line">
                        <input type="number" class="form-control" placeholder="Ancho mts" id="datos"
                               name="datos[]" step="0.01" min="0" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>

                <label>Espesor</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">crop</i>
                    </span>
                    <div class="form-line"> 
                       <input type="number" id="datos"  class="form-control" placeholder="Espesor mts" name="datos[]" min="0" step="0.01" required> 
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>

                
                <button class="btn btn-primary waves-effect" type="submit">CALCULAR</button>
            </form>
        </div>
    </div>

          
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function(){
           $('#proveedor').on('change', onSelectTabla);
       });

       function onSelectTabla() {
           var obra_id = $(this).val();
           //ajax
           $.get('/materialPresupuesto/'+obra_id+, function (data){
               var html_table = '';
               for(var i=0; i<data.length; i++){
                    html_table += '<tr>' +
                                '<td>'+data[$i].id+ '</td>' +
                                '<td>'+Descripción+'</td>'+
                                '<td>'+Unidad+'</td>'+
                                '<td>'+Tipo+'+</td>'+
                                '<td>'+Marca+'</td>'+
                                '<td>'+Precio compra+'</td>'+
                                '<td>'+Cantidad+'</td>'+
                                '<td>'+Total+'</td>'+
                                '</tr>';
                     $('#result').html(html_table);           
               }
           });
       }
   </script> 

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
