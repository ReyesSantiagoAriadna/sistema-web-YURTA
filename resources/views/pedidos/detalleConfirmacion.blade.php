<?php $nav_pedidos = 'active'; ?>
<?php $nav_pedidos_mostrar = 'active'; ?>
@extends('admin_panel')
@section('contenido')
    <div class="block-header">
        <h2>CONFIRMAR PEDIDO</h2>
    </div>
    @if ( session('mensaje') )
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif
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
                            <th>Stock</th> 
                            <th>Requerido</th> 
                        </tr>
                        </thead>
                        <tfoot>
                        <tr> 
                            <th>#</th>
                            <th>Material</th> 
                            <th>Stock</th>
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

@endsection