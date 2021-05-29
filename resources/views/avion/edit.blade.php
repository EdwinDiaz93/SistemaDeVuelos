@extends('layout')


@section("content")
<form method="POST" action="{{route("avion.update",["avione"=>$vars["avion"]->idavion])}}">
    @method("PUT")

    <h1>Crear avion</h1>
        @include('avion.form',$vars)
    <input type="submit" class="mt-2 btn btn-primary" value="Actualizar  Avion">
    <a href="{{route("avion.index")}}" class="btn btn-success mt-2">Regresar</a>
</form>
@endsection