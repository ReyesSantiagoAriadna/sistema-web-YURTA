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
                    <h2>PRESUPUESTO Mts2</h2>
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
                <div class="body table-responsive"> 
                    <form method="POST" action="{{ route('presupuesto_export') }}">
                        @csrf
                    <h2></h2>
                    <div style="float:right"> 
                        <button class="btn btn-primary waves-effect" type="submit">Descargar</button>
                    </div>   
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
                            
                                
                        @for ($i = 0; $i < sizeof($resultado); $i++) 
                             <tr>       
                                <td>{{$resultado[$i]->descripcion}}</td>
                                <td>{{$resultado[$i]->razon_social}}</td>   
                                <td>{{$datos[$i]}}</td>
                                <td>{{$resultado[$i]->unidad}}</td>
                                <td>{{$resultado[$i]->precio_unitario}}</td> 
                                <td>{{$importes[$i]}}</td>   

                                <input type="hidden" name="cantidades[]" id="cantidades" value="{{$importes[$i]}}" class="form-control">
                                <input type="hidden" name="materiales[]" id="materiales" value="{{$datos[$i]}}" class="form-control">
                                                                                          
                            <td><i class="fa fa-500px" aria-hidden="true"></i></td>
                           </tr> 
                         @endfor
                                
                        <tr>
                            <td>agua</td>
                                <td>----</td>   
                                <td>{{$t_agua}}</td>
                                <td>lts</td>
                                <td>---</td>
                                <td>-----</td>  
                                
                                <input type="hidden" name="t_agua" id="t_agua" value="{{$t_agua}}">
                        </tr>

                        <tr  >
                            <td colspan=5></td>
                            <td>Total: ${{$total}}</td>
                            <input type="hidden" name="total" id="total" value="{{$total}}">
                        </tr>
                        </tbody>
                    </table> 
                    </form>
                </div> 
            </div>
        </div>
    </div>
 @endsection

