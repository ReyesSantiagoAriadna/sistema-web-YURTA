@extends('layouts.app')

@section('content')

    <h1>Tipo de obra {{$tipo->nombre}}</h1>

    @if(session('mensaje'))
        <div class="alert-success">{{session('mensaje')}}</div>
    @endif
    <form action="{{route('tipo_obra.update',$tipo->id)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group row">
            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

            <div class="col-md-6">
                <input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{$tipo->descripcion }}" required >

                @if ($errors->has('descripcion'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
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