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

            <ol class="breadcrumb breadcrumb-bg-orange">
                <li  style = "font-size: 18px"><a href="javascript:void(0);"><i class="material-icons">ev_station</i> Materiales</a></li>
                <li  style = "font-size: 18px" class="active"><i class="material-icons">add_circle</i> Nuevo</li>
             </ol>


            <form method="POST" action="{{ route('material_agregar') }}" id="formenvio_1">
                @csrf
                <h2 class="card-inside-title">Datos del material</h2>
                <label id="alert-name" class="font-bold col-grey" for="name">* Campos Obligatorios</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">description</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Descripción"
                               id="descripcion" name="descripcion" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>
 
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">merge_type</i>
                    </span>
                    <div class="form-line">
                        <select name="tipo" class="form-control" id="tipo" required autofocus>
                            <option value="">Seleccione el tipo de material</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{$tipo['id']}}">{{$tipo['descripcion']}}</option>
                            @endforeach 
                         {{-- <option value="" name="add" id="add_data">
                             <button  class="btn btn-primary btn-sm waves-effect" type="button" name="add" id="add_data">Agregar</button>  
                        
                            </option>   --}}  
                        </select>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">branding_watermark</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Marca" id="marca" name="marca" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>
                
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">flag</i>
                    </span>
                    <div class="form-line">
                        <select name="unidad" class="form-control" id="unidad" required autofocus>
                            <option value="">Seleccione la unidad de medida del material</option>
                            @foreach ($unidades as $unidad)
                                <option value="{{$unidad['id']}}">{{$unidad['descripcion']}}</option>
                            @endforeach
                            
                            
                        </select> 
                    </div> 
                    <label style="float:left" class="help-info">*</label>
                </div>


                
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">assignment</i>
                    </span>
                    <div class="form-line">
                        <input type="number" class="form-control" placeholder="Cantidad" id="existencias" name="existencias" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">monetization_on</i>
                    </span>
                    <div class="form-line">
                        <input type="number" class="form-control" placeholder="Precio de compra" id="precio_unitario"
                               name="precio_unitario" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
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
                    <div style="float:left" class=" help-info">*</div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="material-icons">add_a_photo</i>
                    </span>
                    <div class="form-line">
                        <input type="file" id="upload-file-selector" class="form-control"  onchange="readURL(this);" required>
                    </div>
                    <div style="float:left" class=" help-info">*</div>
                </div>

                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                    </span>
                    <div class="form-line">
                        <img id="blah" src="#" alt="imagen" />
                    </div>
                </div>


                <input type="hidden" name="url" id="url"> 
            </form>
            <br>
            <br>
            <input type="button" name="grabar" id="grabar" class="btn btn-primary" value="Aceptar" onclick="saveimg()"> 

        </div>
        <!-- The core Firebase JS SDK is always required and must be listed first -->

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
                var ref = firebase.storage().ref('/materiales/');
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