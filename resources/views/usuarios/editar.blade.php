@extends('layouts.app')

@section('content')

    <h1>Usuario {{$usuario->nombre}}</h1>

    @if(session('mensaje'))
        <div class="alert-success">{{session('mensaje')}}</div>
    @endif
    <form action="{{route('usuarios.update',$usuario->id)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $usuario->name }}" required >

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $usuario->email}}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>



        <div class="form-group row">
            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('telefono') }}</label>

            <div class="col-md-6">
                <input id="telefono" type="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ $usuario->telefono }}" required autofocus>

                @if ($errors->has('telefono'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                @endif
            </div>
        </div>



        <div class="form-group row">
            <label for="puesto" class="col-md-4 col-form-label text-md-right">{{ __('puesto') }}</label>

            <div class="col-md-6">
                <input id="puesto" type="text" class="form-control{{ $errors->has('puesto') ? ' is-invalid' : '' }}" name="puesto" value="{{ $usuario->puesto }}" required autofocus>

                @if ($errors->has('puesto'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('puesto') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-warning">
                    Actualizar
                </button>
            </div>
        </div>
    </form>
@endsection