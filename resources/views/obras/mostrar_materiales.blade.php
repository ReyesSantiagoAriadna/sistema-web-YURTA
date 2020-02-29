@extends('panel')
@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto mr-auto">
                            <a class="fa fa-filter"></a>
                            <input type="text" class="form-control pull-right" style="width:90%" id="search" placeholder="Buscar usuario">
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{route('agregar_material_obra')}}">Agregar</a>                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('mensaje'))
                        <div class="alert-success">{{session('mensaje')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"/>
                                <span aria-hidden="true">&times</span>
                        </div>
                    @endif
 
                    <h4>Descripcion: {{$obra->descripcion}}</h4>
                    <h4>Fecha inicio: {{$obra->fech_ini}}</h4>
                    <h4>Dependencia: {{$obra->dependencia}}</h4>

                    <table id="tabla-materiales  .table-responsive" class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Obra</th>
                            <th scope="col">Material</th> 
                        </tr>
                        </thead>
                        <tbody> 
                            @foreach ($materiales_obra as $item)
                             @if ($item->id_obra == $obra->id)
                             <tr>
                                <td scope="row">{{$item->id}}</td>
                                <td>
                                    {{$item->cantidad}}
                                </td>
                                <td>{{$item->id_obra}}</td>
                                <td>{{$item->mat_obra}}</td>  
                            </tr>  
                             @endif                                                           
                            @endforeach         

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

