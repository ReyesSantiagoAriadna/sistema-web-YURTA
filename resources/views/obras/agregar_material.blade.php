<?php $nav_obras = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="block-header">
        <h2>AGREGAR MATERIAL</h2>
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
            <form method="POST" action="{{ route('material_obra_add') }}">
                @csrf
                <input type="hidden" name="obra" id="obra" value="{{$obra->id}}">
                <ol class="breadcrumb breadcrumb-col-orange">
                    <li><a href="javascript:void(0);"><i class="material-icons">local_convenience_store</i> Obras</a></li>
                    <li ><i class="material-icons">visibility</i> Mostrar</li>
                    <li class="active"><i class="material-icons">add_box</i> Agregar Material</li>
                    <div style="float:right;">
                        <button class="btn btn-primary" type="submit">
                            Aceptar
                        </button>
                    </div>
                </ol>

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
                            <th>Agregar</th>
                            <th>Cantidad</th>
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
                            <th>Agregar</th>
                            <th>Cantidad</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($materiales as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->descripcion}}</td>
                                <td>{{$item->unidad}}</td>
                                <td>{{$item->tipo}}</td>
                                <td>{{$item->marca}}</td>
                                <td>{{$item->precio_unitario}}</td>
                                <td>
                                    <input type="checkbox" name="c1[]" id="{{$item->id}}" value="{{$item->id}}"  class="filled-in chk-col-orange">
                                    <label for="{{$item->id}}"></label>
                                    <input type="hidden" name="cantidades[]" id="cantidades" value="{{$item->id}}" class="form-control">
                                </td>
                                <td>
                                    <input name="c2[]" id="c2" type="number" class="form-control"   min="1" max="{{$item->existencias}}" >
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
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