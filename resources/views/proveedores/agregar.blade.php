<?php $nav_proveedores = 'active'; ?>
<?php $nav_proveedores_agregar = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="card">
        <div class="header">
            <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
            <h2>
                PROVEEDOR
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
        @if(count($errors) > 0)
            <div class="errors">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
    
            <ol class="breadcrumb breadcrumb-col-orange">
                <li><a href="javascript:void(0);"><i class="material-icons">people</i> Proveedores</a></li>
                <li class="active"><i class="material-icons">add_circle</i> Nuevo</li>
            </ol>
            <form method="POST" action="{{ route('crear_proveedor') }}">
                @csrf
                <h2 class="card-inside-title">Datos del proveedor</h2>
                <label id="alert-name" class="font-bold col-grey" for="name">* Campos Obligatorios</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">people</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Nombre" id="razon_social" name="razon_social" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">phone</i>
                    </span>
                    <div class="form-line">
                        <input type="text"  class="form-control" max="10" placeholder="Teléfono" id="telefono" name="telefono" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" placeholder="Correo" id="email" name="email" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">add_location</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Dirección" id="direccion" name="direccion" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>
                <button class="btn btn-primary waves-effect" type="submit">REGISTRAR</button>
            </form>

        </div>
{{--        <div class="row clearfix js-sweetalert">
            <button class="btn btn-primary waves-effect" data-type="success">CLICK ME</button>
        </div>
        <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

        <script src="../../js/pages/ui/dialogs.js"></script>--}} 

<script>
	@if(Session::has('message'))
		var type="{{Session::get('alert-type','info')}}"

	
		switch(type){
			case 'info':
		         toastr.info("{{ Session::get('message') }}");
		         break;
	        case 'success':
	            toastr.success("{{ Session::get('message') }}");
	            break;
         	case 'warning':
	            toastr.warning("{{ Session::get('message') }}");
	            break;
	        case 'error':
		        toastr.error("{{ Session::get('message') }}");
		        break;
		}
	@endif
</script>


@endsection