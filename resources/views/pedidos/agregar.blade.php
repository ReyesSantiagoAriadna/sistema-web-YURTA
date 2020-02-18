@extends('panel')
@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Agregar pedido</h3>
                <div class="row">
                </div>
            </div>
            <div class="card-body">

                @if(session('mensaje'))
                <div class="alert alert-success">
                    {{session('mensaje')}}
                </div>
                @endif 
                    <form method="POST" action="{{route('crear_pedido')}}">
                        @csrf
                    <div class="form-group row">
                        <label for="fecha_p" class="col-md-4 col-form-label text-md-right">{{ __('Fecha  pedido') }}</label>

                        <div class="col-md-6">
                            <input id="fecha_p" type="date" class="form-control{{ $errors->has('fecha_p') ? ' is-invalid' : '' }}" name="fecha_p" value="{{ old('fecha_p') }}" required autofocus>

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
                            <input id="fecha_conf" type="date" class="form-control{{ $errors->has('fecha_conf') ? ' is-invalid' : '' }}" name="fecha_conf" value="{{ old('fecha_conf') }}" required autofocus>

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
                            <input id="estado" type="number" class="form-control{{ $errors->has('estado') ? ' is-invalid' : '' }}" name="estado" value="{{ old('estado') }}" required autofocus>

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
                             <select name="obra" class="form-control" id="select-obra" required autofocus>
                                <option value="">Seleccione la obrar</option>
                                @foreach ($obras as $obra)
                                    <option value="{{$obra['id']}}">{{$obra['descripcion']}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('obra'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('obra') }}</strong>
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