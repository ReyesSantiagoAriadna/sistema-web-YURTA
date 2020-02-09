@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Agregar proveedor</h3>
                <div class="row">
                </div>
            </div>
            <div class="card-body">

                @if(session('mensaje'))
                <div class="alert alert-success">
                    {{session('mensaje')}}
                </div>
                @endif 
                    <form method="POST" action="{{ route('crear_proveedor') }}">
                        @csrf
                    <div class="form-group row">
                        <label for="razon_social" class="col-md-4 col-form-label text-md-right">{{ __('Razon Social') }}</label>

                        <div class="col-md-6">
                            <input id="razon_social" type="text" class="form-control{{ $errors->has('razon_social') ? ' is-invalid' : '' }}" name="razon_social" value="{{ old('razon_social') }}" required autofocus>

                            @if ($errors->has('razon_social'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('razon_social') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>  


                    <div class="form-group row">
                        <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                        <div class="col-md-6">
                            <input id="telefono" type="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}" required autofocus>

                            @if ($errors->has('telefono'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('telefono') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>

                        <div class="col-md-6">
                            <input id="direccion" type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ old('direccion') }}" required autofocus>

                            @if ($errors->has('direccion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('direccion') }}</strong>
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