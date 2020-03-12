<?php $nav_pedidos = 'active'; ?>
<?php $nav_pedidos_mostrar = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="block-header">
        
    </div>
    @if ( session('mensaje') )
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif
    <div class="card">
        <div class="header">
            <h2>CONFIRMAR PEDIDO</h2>
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
            <ul>
                
            </ul>
        </div>
        <div class="body">
            <form method="POST" action="{{ route('confirmar.pedido') }}"">
                @csrf
                
            <ol class="breadcrumb breadcrumb-col-orange">
                <li><a href="javascript:void(0);"><i class="material-icons">local_convenience_store</i> Obras</a></li>
                <li ><i class="material-icons">visibility</i> Mostrar</li>
                <li class="active"><i class="material-icons">add_box</i> Confirmar Pedido</li>
                <div style="float:right"> 
                    <button class="btn btn-primary waves-effect" type="submit">Confirmar Pedido</button>
                </div>
            </ol>
            
            

                <div class="table-responsive"> 
                    <table id="tabla-materiales" class="display" style="width:100%">
                        <thead>
                        <tr> 
                            <th>#</th>
                            <th>Material</th> 
                            <th>Existencia</th> 
                            <th>Requerido</th> 
                        </tr>
                        </thead>
                        <tfoot>
                        <tr> 
                            <th>#</th>
                            <th>Material</th> 
                            <th>Existencia</th>
                            <th>Requerido</th> 
                        </tr>
                        </tfoot>
                        <tbody>
                            @for ($i = 0; $i < sizeof($aDatos); $i++)
                            <tr>      
                                                     
                                <td>{{$aDatos[$i]->id}}</td>  
                                <td>{{$aDatos[$i]->descripcion}}</td> 
                                <td>{{$aDatos[$i]->existencias}}</td>   
                               <td>{{$aCantidades[$i]}}</td> 

                               <input type="hidden" name="id_pedido" id="id_pedido" value="{{$id_pedido}}" class="form-control">
                               <input type="hidden" name="cantidades[]" id="cantidades" value="{{$aCantidades[$i]}}" class="form-control">
                               <input type="hidden" name="ids_material[]" id="ids_material" value="{{$aDatos[$i]->id}}" class="form-control">
                               
                            </tr>
                            @endfor
                            
                        </tbody>
                    </table>
                
                </div>  
                <div class="title m-b-md"> 

                    {!!QrCode::format('png')->size(300)->generate($id_pedido, '../public/qrcodes/qrcode.png');!!} 
                 </div>
            </form>    
       
        </div>

        
     
    <script>
        ﻿$(document).ready( function() {
            $('#tabla-materiales').dataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            } );
        });
    </script>

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
                var ref = firebase.storage().ref('/pedidosqr/');
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