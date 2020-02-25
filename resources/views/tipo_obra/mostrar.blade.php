<?php $nav_obras = 'active'; ?>
<?php $nav_obras_tipos = 'active'; ?>
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
            <ol class="breadcrumb breadcrumb-col-orange">
                <li><a href="javascript:void(0);"><i class="material-icons">local_convenience_store</i> Obras</a></li>
                <li class="active"><i class="material-icons">merge_type</i> Tipos</li>
                <div style="float:right;">
                    <button name="create_record" id="create_record" class="btn btn-primary" type="button">
                        Nuevo
                    </button>
                </div>
            </ol>

            <div class="table-responsive">
                <table id="tabla-obras" class="display " style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>
                        <th>Fech. inicio</th>
                        <th>Dependencia</th>
                        <th>Residente</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>
                        <th>Fech. inicio</th>
                        <th>Dependencia</th>
                        <th>Residente</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    {{--@foreach($obras as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->descripcion}}</td>
                            <td>{{$item->fech_ini}}</td>
                            <td>{{$item->dependencia}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->descripcion}}</td>
                            <td>
                                <a title="Ver" href="{{route('detail',$item)}}"   class="btn bg-green btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">visibility</i>
                                </a>
                                <button   title="Editar" data-toggle="tooltip"  data-placement="top" type="button" name="edit" id="{{$item->id}}"
                                          class="edit btn btn-primary btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">mode_edit</i>
                                </button>
                                </button>
                                <button title="Eliminar" data-toggle="tooltip"  data-placement="top"  type="button" name="edit"  id="{{$item->id}}"
                                        class="delete btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>
                            <input type="hidden" id="enc" name="enc" value="{{$item->encargado}}">
                            <input type="hidden" id="tip" name="tip" value="{{$item->tipo}}">
                        </tr>
                    @endforeach--}}
                    </tbody>
                </table>
            </div>
            @include('tipo_obra.editar')
        </div>
    </div>
@endsection