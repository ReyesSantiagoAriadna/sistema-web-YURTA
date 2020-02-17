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
                            <a class="btn btn-primary" href="{{route('material_agregar')}}">Agregar</a>
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
                            <th scope="col">Descripcion</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Existencia</th>
                            <th scope="col">Precion unitario</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                     @foreach ($materiales as $item)          
                          <tr>
                          <th scope="row">{{$item->id}}</th>
                            <td>
                              {{$item->descripcion}}
                            </td>
                            <td>{{$item->unidad}}</td>
                            <td>{{$item->tipo}}</td>
                            <td>{{$item->marca}}</td>
                            <td>{{$item->existencias}}</td>
                            <td>{{$item->precio_unitario}}</td>
                            <td>{{$item->proveedor}}</td>
                            <td>
                              <a href="{{route('material_editar',$item)}}" class="btn btn-warning btn-sm">Editar</a>
                            
                              <form action="{{route('material_eliminar',$item)}}" class="d-inline" method="POST">
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

