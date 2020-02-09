@extends('plantilla')

<div class="container my4">
    <h1>Editar</h1>

    @if(session('mensaje'))
    <div class="alert alert-success">
        {{session('mensaje')}}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif

<form action="{{route('update_proveedor',$proveedor->id)}}"" method="POST">
@method('PUT') 
@csrf

    @foreach ($errors->get('razon_social') as $error)
    <div class="alert alert-danger">
        El nombre es requerido

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @endforeach

    @foreach ($errors->get('telefono') as $error)
    <div class="alert alert-danger">
        El telefono es requerido

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @endforeach
    
    @foreach ($errors->get('direccion') as $error)
    <div class="alert alert-danger">
        La direccion es requerido

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @endforeach        

    <input type="text" name="razon_social" placeholder="Razon Social" class="form-control mb-2" value="{{$proveedor->razon_social}}">
    <input type="texy" name="telefono" placeholder="Telefono" class="form-control mb-2" value="{{$proveedor->telefono}}">
    <input type="text" name="direccion" placeholder="Direccion" class="form-control mb-2" value="{{$proveedor->direccion}}">
    <button class="btn btn-primary btn-block" type="submit">Editar</button>

</form>
</div>