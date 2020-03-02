<?php $nav_materiales = 'active'; ?>
<?php $nav_materiales_mostrar = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="block-header">
        <h2>MATERIALES</h2>
        @if(session('mensaje'))
            <div class="alert-success">
                <label>{{session('mensaje')}}</label>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"/>
                <span aria-hidden="true">&times</span>
            </div>
        @endif
        @if(session()->has('mensaje'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
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
                <li><a href="javascript:void(0);"><i class="material-icons">ev_station</i> Materiales</a></li>
                <li class="active"><i class="material-icons">visibility</i> Mostrar</li>
            </ol>

            <div class="table-responsive">
                <table id="tabla-materiales" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>                        
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Existencias</th>
                        <th>Unidad</th>
                        <th>Stock</th>
                        <th>Precio compra</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>                        
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Existencias</th>
                        <th>Unidad</th>
                        <th>Stock</th>
                        <th>Precio compra</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->descripcion}}</td>                            
                            <td>{{$item->descripcion_tipo}}</td>
                            <td>{{$item->marca}}</td>
                            <td>{{$item->existencias}}</td>
                            <td>{{$item->descripcion_unidad}}</td>
                            <td>{{$item->cantidad_minima}}</td>
                            <td>{{$item->precio_unitario}}</td>
                            <td>{{$item->proveedor_nombre}}</td>
                            <td>
                                <button value="{{$item->proveedor}}" title="Editar" data-toggle="tooltip"  data-placement="top" type="button" name="edit" id="{{$item->id}}"
                                         class="edit btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">mode_edit</i>
                                </button>
                                <button title="Eliminar" data-toggle="tooltip"  data-placement="top"  type="button" name="edit"  id="{{$item->id}}"
                                        class="delete btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">delete</i>
                                </button>


                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('materiales.editar')
        </div>
    </div>
@endsection

