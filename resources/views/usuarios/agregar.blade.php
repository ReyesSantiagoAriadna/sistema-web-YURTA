<?php $nav_empleados = 'active'; ?>
<?php $nav_empleados_agregar = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="card">
        <div class="header">
            <h2>
                EMPLEADO
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
                <li><a href="javascript:void(0);"><i class="material-icons">account_circle</i> Empleados</a></li>
                <li class="active"><i class="material-icons">add_circle</i> Nuevo</li>
            </ol>
            <ol class="breadcrumb breadcrumb-bg-orange">
                <li><a href="javascript:void(0);"><i class="material-icons">account_circle</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">add_circle</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">attachment</i> File</a></li>
                <li class="active"><i class="material-icons">extension</i> Extensions</li>
            </ol>
            <form method="POST" action="{{ route('usuarios.add') }}">
                @csrf
                <h2 class="card-inside-title">Datos del empleado</h2>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Nombre" id="name" name="name" required>
                        
                    </div>
                    <small>
                        <label id="alert-name" class="font-bold col-pink" for="name">* Campo Obligatorio</label>
                    </small>
                   
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" placeholder="Correo" id="email" name="email" required>
                    </div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               type="password" class="form-control" placeholder="Contraseña" id="password" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" placeholder="Confirmar la contraseña" id="password-confirm" name="password_confirmation" required>
                    </div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">phone</i>
                    </span>
                    <div class="form-line">
                        <input type="tel" class="form-control" placeholder="Teléfono" id="telefono" name="telefono" required>
                    </div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">accessibility</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Puesto" id="puesto" name="puesto" required>
                    </div>
                </div>
                <button class="btn btn-primary waves-effect" type="submit">REGISTRAR</button>

                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">phone_iphone</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control mobile-phone-number" placeholder="Ex: +00 (000) 000-00-00">
                    </div>
                </div>
            </div>
            </form>
        </div>


@endsection