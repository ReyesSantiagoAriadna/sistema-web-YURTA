<?php $nav_materiales = 'active'; ?>
<?php $nav_materiales_mostrar_unidades = 'active'; ?>
@extends('admin_panel')
@section('contenido')
          <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2> Tipo de Unidades</h2>
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
                            <button  class="btn btn-primary btn-sm waves-effect" type="button" name="add" id="add_data">Agregar</button>  
                        </li>
                    </ul>
                </div>
                <div class="body table-responsive">
                    <ol class="breadcrumb breadcrumb-bg-orange">
                        <li style = "font-size: 18px"><a href="javascript:void(0);"><i class="material-icons">ev_station</i> Materiales</a></li>
                        <li style = "font-size: 18px"class="active"><i class="material-icons">flag</i>Tipo de Unidad</li>
                    </ol>
        
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>DESCRIPCION</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unidadMaterial as $item)
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
                @include('unidadMaterial.editar')
                @include('unidadMaterial.agregar')
            </div>
        </div>
    </div>
@endsection

