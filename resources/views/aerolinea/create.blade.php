@extends('layout')


@section("content")
<form method="POST" action="{{route("aerolinea.store")}}">
    @method("POST")
    <h1>Crear Aerolinea</h1>
        @include('aerolinea.form',$vars)
    <input type="submit" class="mt-2 btn btn-primary" value="Guardar Aerolinea">
    <a href="{{route("aerolinea.index")}}" class="btn btn-success mt-2">Regresar</a>
</form>
@endsection