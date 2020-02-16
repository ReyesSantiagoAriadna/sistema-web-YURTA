@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto mr-auto">
                            <a class="fa fa-filter"></a>
                            <input type="text" class="form-control pull-right" style="width:90%" id="search" placeholder="Buscar pedido">
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{route('agregar_pedido')}}">Agregar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if(session('mensaje'))
                    <div class="alert-success">{{session('mensaje')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>       
                @endif

                    <table id="tabla-materiales" class="table"> 
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Fecha del pedido</th>
                            <th scope="col">Fecha de Confirmacion</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Obra</th> 
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                     @foreach ($pedidos as $item)          
                          <tr>
                          <th scope="row">{{$item->id}}</th> 
                            <td>{{$item->fecha_p}}</td>
                            <td>{{$item->fecha_conf}}</td> 
                            <td>{{$item->estado}}</td>
                            <td>{{$item->obra}}</td> 
                            <td>
                              <a href="{{route('editar_pedido',$item)}}" class="btn btn-warning btn-sm">Editar</a>
                            
                              <form action="{{route('eliminar_pedido',$item)}}" class="d-inline" method="POST">
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

