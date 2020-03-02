<?php $nav_materiales = 'active'; ?>
<?php $nav_materiales_mostrar_tipos = 'active'; ?>
@extends('admin_panel')
@section('contenido')


    <div class="card">
        <div class="header">
            <h2>
               TIPO MATERIAL
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
                <li class="active"><i class="material-icons">add_circle</i> Nuevo</li>
            </ol>


            <form method="POST" action="{{ route('tipo_material_agregar') }}" id="formenvio_1">
                @csrf
                <h2 class="card-inside-title">Datos del tipo de material</h2>
                <label id="alert-name" class="font-bold col-grey" for="name">* Campos Obligatorios</label>
                <br>
                <label>Tipo de Material</label> 
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">merge_type</i>
                    </span>
                    <div class="form-line">
                        <input type="text"  class="form-control" placeholder="Tipo" id="tipo" name="tipo" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>


            </form> 
 
        <!-- The core Firebase JS SDK is always required and must be listed first -->

    
@endsection