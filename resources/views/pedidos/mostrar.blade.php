<?php $nav_pedidos = 'active'; ?>
<?php $nav_pedidos_mostrar = 'active'; ?>
@extends('admin_panel')
@section('contenido')

    <div class="block-header">
        <h2> PEDIDOS</h2>
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
            <ol class="breadcrumb breadcrumb-col-orange">
                <li><a href="javascript:void(0);"><i class="material-icons">local_shipping</i> Pedidos</a></li>
                <li class="active"><i class="material-icons">visibility</i> Mostrar</li>
            </ol>

            <div class="table-responsive">
                <table id="tabla-pedidos" class="display" style="width:100%">

                    <thead>
                        <tr>
                            <th></th>
                            <th colspan="3" style="text-align:center;">OBRA</th>
                            <th colspan="4" style="text-align:center;">PEDIDO</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Residente</th>
                            <th>Fecha pedido</th>
                            <th>Estado</th>
                            <th>Fecha confirmación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                 {{--   <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Residente</th>
                            <th>Fecha pedido</th>
                            <th>Estado</th>
                            <th>Fecha confirmación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Residente</th>
                            <th>Fecha pedido</th>
                            <th>Estado</th>
                            <th>Fecha confirmación</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>--}}
                    <tbody>
                    @foreach($pedidos as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->obra}}</td>
                            <td>{{$item->descripcion}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->fecha_p}}</td>
                            <td>{{$item->estado}}</td>
                            <td>{{$item->fecha_conf}}</td>
                            <td>
                               {{-- <button  title="Editar" data-toggle="tooltip"  data-placement="top" type="button" name="edit" id="{{$item->id}}"
                                         class="edit btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">mode_edit</i>
                                </button>--}}
                                <a title="Ver" href="{{route('pedido.detalle',$item)}}"   class="btn bg-green btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">visibility</i>
                                </a>  
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                ﻿$(document).ready( function() {
                    $('#tabla-pedidos').dataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                        }
                    });
                });
            </script>
            {{--@include('proveedores.editar')--}}
        </div>
    </div>
@endsection

