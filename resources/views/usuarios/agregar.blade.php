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
            <form method="POST" action="{{ route('usuarios.add') }}" id="formenvio_1">
                @csrf
                <h1 class="card-inside-title">Datos del empleado</h1>
                <div style="float:left">
                    <label id="alert-name" class="font-bold col-pink" for="name">* Campos Obligatorios</label>
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Nombre" id="name" name="name" required>
                        
                    </div>
                    <small>
                        <label id="alert-name" class="font-bold col-pink" for="name">*</label>
                    </small>                   
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" placeholder="Correo" id="email" name="email" required>
                    </div>
                    <small>
                        <label id="alert-name" class="font-bold col-pink" for="email">*</label>
                    </small>
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
                    <small>
                        <label id="alert-name" class="font-bold col-pink" for="password">*</label>
                    </small>
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" placeholder="Confirmar la contraseña" id="password-confirm" name="password_confirmation" required>
                    </div>
                    <small>
                        <label id="alert-name" class="font-bold col-pink" for="password-confirm">*</label>
                    </small>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">phone</i>
                    </span>
                    <div class="form-line">
                        <input type="tel" class="form-control" placeholder="Teléfono" id="telefono" name="telefono" required>
                    </div>
                    <small>
                        <label id="alert-name" class="font-bold col-pink" for="telefono">*</label>
                    </small>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">accessibility</i>
                    </span>
                    <div class="form-line">
                      {{-- <input type="text" class="form-control" placeholder="Puesto" id="puesto" name="puesto" required> --}}
                        <select name="puesto" class="form-control" id="puesto" required autofocus>
                            <option value="">Seleccione el puesto</option>
                            <option value="administrador">Administrador</option>
                            <option value="residente">Residente de obra</option>
                            <option value="gerente">Gerente</option>
                        </select>   
                    </div>
                    <small>
                        <label id="alert-name" class="font-bold col-pink" for="puesto">*</label>
                    </small>
                </div>
              <button class="btn btn-primary waves-effect" type="submit">REGISTRAR</button>
 

{{--                elegir imagen de usuario
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">add_a_photo</i>
                    </span>
                    <div class="form-line">
                        <input type="file" id="upload-file-selector" class="form-control"  onchange="readURL(this);" required>
                    </div>
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                    </span>
                    <div class="form-line">
                        <img id="blah" src="#" alt="imagen" />
                    </div>
                </div>
                <input type="hidden" name="url" id="url"> --}}


            </form>

            <input type="button" name="grabar" id="grabar" class="btn btn-primary waves-effect" value="Agregar" onclick="saveimg()">

        </div>

        <div class="input-group input-group-lg">

            <div class="form-line">

            </div>
        </div>




        <script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.9.0/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.9.0/firebase-storage.js"></script>
        <script>
            // Your web app's Firebase configuration
            const firebaseConfig = {
                apiKey: "AIzaSyB3_eHqhTh_OHewWL1Mg3YvxDMMWrn9w_Q",
                authDomain: "yurta-b4d1d.firebaseapp.com",
                databaseURL: "https://yurta-b4d1d.firebaseio.com",
                projectId: "yurta-b4d1d",
                storageBucket: "yurta-b4d1d.appspot.com",
                messagingSenderId: "1091299166428",
                appId: "1:1091299166428:web:133c7801c3c5509b350c19",
                measurementId: "G-6VYB96F10Z"
            };
            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);
            // firebase.analytics();
        </script>
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#blah')
                            .attr('src', e.target.result)
                            .width(150)
                            .height(200);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

        </script>

        <script type="text/javascript">
            function saveimg(){
                var ref = firebase.storage().ref('/usuarios/');
                var button = document.getElementById("upload-file-selector");
                const file = button.files[0];
                const name = (+new Date()) + '-' + file.name;
                const metadata = { contentType: file.type };
                const task = ref.child(name).put(file, metadata);
                task
                    .then(snapshot => snapshot.ref.getDownloadURL())
                    .then( (url) => {
                        console.log('url:',url);
                        document.getElementById("url").value = url;
                        $("#formenvio_1").submit();
                    } ).catch(console.error);
            }

        </script>

@endsection