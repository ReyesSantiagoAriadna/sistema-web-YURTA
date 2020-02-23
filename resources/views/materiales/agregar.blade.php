<?php $nav_materiales = 'active'; ?>
<?php $nav_materiales_agregar = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="card">
        <div class="header">
            <h2>
                MATERIAL
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
            <form method="POST" action="{{ route('material_agregar') }}">
                @csrf
                <h2 class="card-inside-title">Datos del material</h2>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">description</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Descripción" id="descripcion" name="descripcion" required>
                    </div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">flag</i>
                    </span>
                    <div class="form-line">
                        <input type="tel" class="form-control" placeholder="Unidad" id="unidad" name="unidad" required>
                    </div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">merge_type</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Tipo" id="tipo" name="tipo" required>
                    </div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">branding_watermark</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Marca" id="marca" name="marca" required>
                    </div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">assignment</i>
                    </span>
                    <div class="form-line">
                        <input type="number" class="form-control" placeholder="Existencias" id="existencias" name="existencias" required>
                    </div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">monetization_on</i>
                    </span>
                    <div class="form-line">
                        <input type="number" class="form-control" placeholder="Precio de compra" id="precio_unitario"
                               name="precio_unitario" required>
                    </div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">people</i>
                    </span>
                    <div class="form-line">
                        <select name="proveedor" class="form-control" id="proveedor" required autofocus>
                            <option value="">Seleccione el proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{$proveedor['id']}}">{{$proveedor['razon_social']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button class="btn btn-primary waves-effect" type="submit">REGISTRAR</button>
            </form>

        </div>
    {{--        <div class="row clearfix js-sweetalert">
                <button class="btn btn-primary waves-effect" data-type="success">CLICK ME</button>
            </div>
            <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

            <script src="../../js/pages/ui/dialogs.js"></script>--}}

@endsection