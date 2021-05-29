@extends('layout')


@section("content")
<form method="POST" action="{{route("aeropuerto.update",["aeropuerto"=>$vars["aeropuerto"]->codaeropuerto])}}">
    @method("PUT")

    <h1>Editar Aeropuerto</h1>
        @include('aeropuerto.form',$vars)
    <input type="submit" class="mt-2 btn btn-primary" value="Actualizar  Aeropuerto">
    <a href="{{route("aeropuerto.index")}}" class="btn btn-success mt-2">Regresar</a>
</form>
@endsection