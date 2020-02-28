<?php $nav_empleados = 'active'; ?>
<?php $nav_empleados_mostrar = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="block-header">
        <h2>EMPLEADOS</h2>
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
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <li><a href="javascript:void(0);"><i class="material-icons">account_circle</i> Empleados</a></li>
                    </span>
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <li class="active"><i class="material-icons">visibility</i> Mostrar</li>
                    </span>
                </div>
            </ol>
            
            <ol class="breadcrumb breadcrumb-bg-orange">
                
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">attachment</i> File</a></li>
                <li class="active"><i class="material-icons">extension</i> Extensions</li>
            </ol>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">
                    <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                </span>
            </div>

            <div class="table-responsive">
                <table id="tabla-empleado" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Puesto</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Puesto</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($usuarios as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->telefono}}</td>
                            <td>{{$item->puesto}}</td>
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

            @include('usuarios.editar')
        </div>
    </div>
    <script>$(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })</script>
    <script src="js\script.js" rel="stylesheet"></script>
@endsection

