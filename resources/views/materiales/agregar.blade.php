@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Agregar usuario</h3>
                    <div class="row">
                    </div>
                </div>
                <div class="card-body">
                    @if(session('mensaje'))
                    <div class="alert alert-success">
                        {{session('mensaje')}}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    @endif 

                    <form method="POST" action="{{ route('material_add') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion') }}" required autofocus>

                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unidad" class="col-md-4 col-form-label text-md-right">{{ __('Unidad') }}</label>

                            <div class="col-md-6">
                                <input id="unidad" type="text" class="form-control{{ $errors->has('unidad') ? ' is-invalid' : '' }}" name="unidad" value="{{ old('unidad') }}" required>

                                @if ($errors->has('unidad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('unidad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

                            <div class="col-md-6">
                                <input id="tipo" type="text" class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}" name="tipo" required>

                                @if ($errors->has('tipo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="marca" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}</label>

                            <div class="col-md-6">
                                <input id="marca" type="text" class="form-control{{ $errors->has('marca') ? ' is-invalid' : '' }}" name="marca" value="{{ old('marca') }}" required autofocus>

                                @if ($errors->has('marca'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('marca') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="existencias" class="col-md-4 col-form-label text-md-right">{{ __('Existencias') }}</label>

                            <div class="col-md-6">
                                <input id="existencias" type="number" class="form-control{{ $errors->has('existencias') ? ' is-invalid' : '' }}" name="existencias" value="{{ old('existencias') }}" required autofocus>

                                @if ($errors->has('existencias'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('existencias') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="precio_unitario" class="col-md-4 col-form-label text-md-right">{{ __('Precio unitario') }}</label>

                            <div class="col-md-6">
                                <input id="precio_unitario" type="number" class="form-control{{ $errors->has('precio_unitario') ? ' is-invalid' : '' }}" name="precio_unitario" value="{{ old('precio_unitario') }}" required autofocus>

                                @if ($errors->has('precio_unitario'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('precio_unitario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="proveedor" class="col-md-4 col-form-label text-md-right">{{ __('Proveedor') }}</label>

                            <div class="col-md-6">
                                 <select name="proveedor" class="form-control" id="select-proveedor" required autofocus>
                                    <option value="">Seleccione el proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{$proveedor['id']}}">{{$proveedor['razon_social']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('proveedor'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('proveedor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

