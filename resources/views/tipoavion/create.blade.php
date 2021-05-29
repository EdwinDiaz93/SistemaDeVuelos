@extends('layout')


@section("content")
<form method="POST" action="{{route("tipoavion.store")}}">
    @method("POST")

    <h1>Crear tipo de avion</h1>
        @include('tipoavion.form',$tipoavion)
    <input type="submit" class="mt-2 btn btn-primary" value="Guardar Tipo Avion">
    <a href="{{route("tipoavion.index")}}" class="btn btn-success mt-2">Regresar</a>
</form>
@endsection