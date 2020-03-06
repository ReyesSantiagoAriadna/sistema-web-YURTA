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
                <li style="float:left"> 
                    <a class="btn btn-primary waves-effect" type="submit" href="{{route('agregar_tipo_obra')}}">Agregar</a>
                </li>
            </ul>
        </div>
        <div class="body"> 
            <ol class="breadcrumb breadcrumb-bg-orange">
                <li style =  "font-size: 18px"><a href="javascript:void(0);"><i class="material-icons">local_convenience_store</i> Obras</a></li> 
                <li style =  "font-size: 18px" class="active"><i class="material-icons">device_hub</i>Tipos</li>

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
            @include('tipo_obra.editar')
        </div>
    </div>
@endsection