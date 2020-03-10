<?php $nav_pedidos = 'active'; ?>
<?php $nav_pedidos_mostrar = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="block-header">
        
    </div>
    @if ( session('mensaje') )
     <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif
    <div class="card">
        <div class="header">
            <h2>CONFIRMAR PEDIDO</h2>
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
            <ul>
                
            </ul>
        </div>
        <div class="body">
            <form method="POST" action="{{ route('confirmar.material') }}">
                @csrf
            <ol class="breadcrumb breadcrumb-col-orange">
                <li><a href="javascript:void(0);"><i class="material-icons">local_convenience_store</i> Obras</a></li>
                <li ><i class="material-icons">visibility</i> Mostrar</li>
                <li class="active"><i class="material-icons">add_box</i> Confirmar Pedido</li>
                <div style="float:right"> 
                    <button class="btn btn-primary waves-effect" type="submit">Verificar</button>
                </div>
            </ol>
            
           

                <div class="table-responsive">
                    <table id="tabla-materiales" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th> 
                            <th>Material</th>
                            <th>Cantidad</th>
                            <th>Obra</th> 
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th> 
                            <th>Material</th>
                            <th>Cantidad</th> 
                            <th>Obra</th> 
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$id_pedido}}</td>                            
                                <td>{{$item->descripcion}}</td>                           
                                <td>{{$item->cantidad}}</td> 
                                <td>{{$item->des_obra}}</td> 
                                

                                <input type="hidden" name="id_pedido" id="id_pedido" value="{{$id_pedido}}" class="form-control"> 
                                <input type="hidden" name="ids_material[]" id="ids_material" value="{{$item->id}}" class="form-control">
                                <input type="hidden" name="cantidades[]" id="cantidades" value="{{$item->cantidad}}" class="form-control">
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                
                </div>  
               

            </form>    
       
        </div>

        
     
    <script>
        ﻿$(document).ready( function() {
            $('#tabla-materiales').dataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            } );
        });
    </script>

@endsection