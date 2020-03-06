<?php $nav_proveedores = 'active'; ?>
<?php $nav_proveedores_mostrar = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="block-header">
        
    </div>
    <div class="card">
        <div class="header">
            <h2> PROVEEDORES</h2>
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

            <ol class="breadcrumb breadcrumb-bg-orange">
                <li style = "font-size: 18px"><a href="javascript:void(0);"><i class="material-icons">people</i> Proveedores</a></li>
                <li style = "font-size: 18px" class="active"><i class="material-icons">visibility</i> Mostrar</li>
            </ol>

            <div class="table-responsive">
                <table id="tabla-proveedores" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Razón Social</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Razón Social</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($proveedores as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->razon_social}}</td>
                            <td>{{$item->telefono}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->direccion}}</td>
                            <td>
                                <button  title="Editar" data-toggle="tooltip"  data-placement="top" type="button" name="edit" id="{{$item->id}}"
                                         class="edit btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">mode_edit</i>
                                </button>
                                <button title="Eliminar" data-toggle="tooltip"  data-placement="top"  type="button" name="edit" id="{{$item->id}}"
                                        class="delete btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">delete</i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('proveedores.editar')
        </div>
    </div>
@endsection

