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
                            <a class="btn btn-primary" href="{{route('proveedor>agregar')}}">Agregar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabla-proveedores" class="table"> 
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Razon Social</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                     @foreach ($proveedores as $item)          
                          <tr>
                          <th scope="row">{{$item->id}}</th>
                            <td>
                              {{$item->razon_social}}
                            </td>
                            <td>{{$item->telefono}}</td>
                            <td>{{$item->direccion}}</td>
                            <td>
                              <a href="{{route('proveedor>editar', $item)}}" class="btn btn-warning btn-sm">Editar</a>
                            
                              <form action="{{route('eliminar_proveedor', $item)}}" class="d-inline" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                              </form>
                            </td>
                          </tr>
                    @endforeach    
                        </tbody>
                     </table>          
                </div>
            </div>
        </div>
    </div>
@endsection

