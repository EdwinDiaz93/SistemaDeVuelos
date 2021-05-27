@extends('layout')


@section("content")
<form method="POST" action="{{route("tipoavion.update",["tipoavion"=>$tipoavion->idTipoAvion])}}">
    @method("PUT")

    <h1>Crear red social</h1>
        @include('tipoavion.form',$tipoavion)
    <input type="submit" class="mt-2 btn btn-primary" value="Actualizar Tipo Avion">
    <a href="{{route("tipoavion.index")}}" class="btn btn-success mt-2">Regresar</a>
</form>
@endsection