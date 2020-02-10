@extends('panel')
@section('contenido')
    @if(session('mensaje'))
        <div class="alert-success">{{session('mensaje')}}</div>
    @endif

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
                            <a class="btn btn-primary" href="/agregar_usuario">Agregar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabla-usuarios" class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Puesto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($usuarios as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <th scope="row">{{$item->name}}</th>
                                <th scope="row">{{$item->email}}</th>
                                <th scope="row">{{$item->telefono}}</th>
                                <th scope="row">{{$item->puesto}}</th>
                                <th>
                                    <a href="{{route('usuarios>editar',$item)}}" class="btn btn-warning btn-sm">Editar</a>
                                    <form  class="d-inline" action="{{route('usuarios.eliminar',$item)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

