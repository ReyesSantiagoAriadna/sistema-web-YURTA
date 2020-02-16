@extends('panel')

@section('contenido')

    <h1>Pedido {{$pedido->id}}</h1>

    @if(session('mensaje'))
        <div class="alert-success">{{session('mensaje')}}</div>
    @endif
    <form action="{{route('update_pedido',$pedido->id)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group row">
            <label for="fecha_p" class="col-md-4 col-form-label text-md-right">{{ __('Fecha pedidio') }}</label>

            <div class="col-md-6">
                <input id="fecha_p" type="date" class="form-control{{ $errors->has('fecha_p') ? ' is-invalid' : '' }}" name="fecha_p" value="{{$pedido->fecha_p}}" required >

                @if ($errors->has('fecha_p'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha_p') }}</strong>
                                    </span>
                @endif
            </div>
        </div> 


        <div class="form-group row">
            <label for="fecha_conf" class="col-md-4 col-form-label text-md-right">{{ __('Fecha confirmacion') }}</label>

            <div class="col-md-6">
                <input id="fecha_conf" type="date" class="form-control{{ $errors->has('fecha_conf') ? ' is-invalid' : '' }}" name="fecha_conf" value="{{ $pedido->fecha_conf }}" required autofocus>

                @if ($errors->has('fecha_conf'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha_conf') }}</strong>
                                    </span>
                @endif
            </div>
        </div>



        <div class="form-group row">
            <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

            <div class="col-md-6">
                <input id="estado" type="number" class="form-control{{ $errors->has('estado') ? ' is-invalid' : '' }}" name="estado" value="{{ $pedido->estado }}" required autofocus>

                @if ($errors->has('estado'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estado') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="obra" class="col-md-4 col-form-label text-md-right">{{ __('Obra') }}</label>

            <div class="col-md-6">
                <input id="obra" type="number" class="form-control{{ $errors->has('obra') ? ' is-invalid' : '' }}" name="obra" value="{{ $pedido->obra }}" required autofocus>

                @if ($errors->has('obra'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('obra') }}</strong>
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