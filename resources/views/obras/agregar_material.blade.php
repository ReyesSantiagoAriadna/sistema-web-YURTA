@extends('panel')
@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    @if(session('mensaje'))
                    <div class="alert alert-success">
                        {{session('mensaje')}}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    @endif 

                    <form method="POST" action="{{ route('material_obra_add') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="cantidad" class="col-md-4 col-form-label text-md-right">{{ __('Cantidad') }}</label>

                            <div class="col-md-6">
                                <input id="cantidad" type="number" class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" name="cantidad" value="{{ old('cantidad') }}" required autofocus>

                                @if ($errors->has('cantidad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cantidad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="id_obra" class="col-md-4 col-form-label text-md-right">{{ __('Obra') }}</label>

                            <div class="col-md-6">
                                 <select name="id_obra" class="form-control" id="select-obras" required autofocus>
                                    <option value="">Seleccione la obra</option>
                                    @foreach ($obras as $obra)
                                        <option value="{{$obra['id']}}">{{$obra['descripcion']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('id_obra'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('id_obra') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="mat_obra" class="col-md-4 col-form-label text-md-right">{{ __('Materiales') }}</label>
    
                                <div class="col-md-6">
                                     <select name="mat_obra" class="form-control" id="select-materiales" required autofocus>
                                        <option value="">Seleccione el material</option>
                                        @foreach ($materiales as $material)
                                            <option value="{{$material['id']}}">{{$material['descripcion']}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('mat_obra'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mat_obra') }}</strong>
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

