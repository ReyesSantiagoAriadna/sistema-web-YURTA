<?php $nav_obras = 'active'; ?>
<?php $nav_obras_presupuesto= 'active'; ?>
@extends('admin_panel')
@section('contenido')
    
    <!-- #END# Striped Rows -->
    <!-- Bordered Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2></h2>
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
                            <a class="btn btn-primary waves-effect" type="submit">Agregar</a>
                        </li>
                    </ul>
                </div>
                <div class="body table-responsive"> 
                    <h2></h2> 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Proveedor</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>                                 
                                <th>Precio Uni</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody> 
                        @for ($i = 0; $i < sizeof($result); $i++) 
                             <tr> 
                            
                                <td>{{$result[$i]->descripcion}}</td>
                                <td>{{$result[$i]->razon_social}}</td>   
                                <td>{{$datos[$i]}}</td>
                                <td>{{$result[$i]->unidad}}</td>
                                <td>{{$result[$i]->precio_unitario}}</td> 
                                <td>{{$importes[$i]}}</td> 
                                                            
                            <td><i class="fa fa-500px" aria-hidden="true"></i></td>
                           </tr> 
                         @endfor
                        <tr>
                            <td>agua</td>
                                <td>----</td>   
                                <td>{{$t_agua}}</td>
                                <td>lts</td>
                                <td>---</td> 
                        </tr>
                        </tbody>
                    </table>
                    <div class="input-group input-group-lg">
                        <div style="float:right;" >
                            Total: $ <input id="total" value="{{$total}}" name="total" class="form-control" readonly>
                        </div>
                        </div>
                </div> 
            </div>
        </div>
    </div>
 @endsection

