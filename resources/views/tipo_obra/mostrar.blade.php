<?php $nav_obras = 'active'; ?>
<?php $nav_obras_tipos = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="block-header">
        
    </div>
    <div class="card">
        <div class="header">
            <h2> TIPOS DE OBRA</h2>
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
                <div style="float:right;">
                    <button name="create_record" id="create_record" class="btn btn-primary" type="button">
                        Nuevo
                    </button>
                </div>
            </ol>

            <div class="body table-responsive"> 
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Id</th>
                            <th>DESCRIPCION</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tipo as $item)
                    <tr>
                        <td>#</td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->descripcion}}</td>         
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
        </div>
    </div>
@endsection