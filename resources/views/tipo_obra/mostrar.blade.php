@extends('layouts.app')
@section('content')
    @if(session('mensaje'))
        <div class="alert-success">{{session('mensaje')}}</div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                        <h2 class="card-title">Tipo de obra</h2>
                </div>
                <div class="card-body">
                    <form  action="{{route('tipo_obra.agregar')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion') }}" required autofocus>

                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                            <button class="btn btn-success btn-sm" type="submit">Agregar</button>
                    </form>


                    <table id="tabla-tipo" class="table mt-5">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tipo as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <th scope="row">{{$item->descripcion}}</th>
                                <th>
                                    <a href="{{route('tipo_obra.editar',$item)}}" class="btn btn-warning btn-sm">Editar</a>
                                    <form  class="d-inline" action="{{route('tipo_obra.eliminar',$item)}}" method="POST">
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

