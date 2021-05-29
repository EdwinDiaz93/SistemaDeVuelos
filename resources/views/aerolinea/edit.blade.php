@extends('layout')


@section("content")
<form method="POST" action="{{route("aerolinea.update",$vars["aerolinea"]->codaerolinea)}}">
    @method("PUT")
    <h1>Editar Aerolinea</h1>
        @include('aerolinea.form',$vars)
    <input type="submit" class="mt-2 btn btn-primary" value="Actualizar Aerolinea">
    <a href="{{route("aerolinea.index")}}" class="btn btn-success mt-2">Regresar</a>
</form>
@endsection