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
                            <a class="btn btn-primary" href="{{route('obra>agregar')}}">Agregar</a>                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('mensaje'))
                        <div class="alert-success">{{session('mensaje')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </div>
                    @endif

                    <table id="tabla-materiales  .table-responsive" class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Fech. inicio</th>
                            <th scope="col">Dependencia</th>
                            <th scope="col">Encargado</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($obras as $item)
                            <tr>
                                <td scope="row">{{$item->id}}</td>
                                <td>
                                    {{$item->descripcion}}
                                </td>
                                <td>{{$item->fech_ini}}</td>
                                <td>{{$item->dependencia}}</td>
                                <td>{{$item->encargado}}</td>
                                <td>{{$item->tipo_obra}}</td>
                                <th>
                                    <a href="{{route('obra_editar',$item)}}" class="btn btn-warning btn-sm">Editar</a>
                                    <form  class="d-inline" action="{{route('obra.eliminar',$item)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                    </form>
                                    <a class="btn btn-success " href="{{route('agregar_material_obra')}}">Agregar material</a>
                                    <a class="btn btn-default " href="{{route('mostrar_material_obra',$item)}}">Ver materiales</a>                                
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

