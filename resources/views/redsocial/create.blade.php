@extends('layout')


@section("content")
<form method="POST" action="{{route("red.store")}}">
    @method("POST")

    <h1>Crear red social</h1>
        @include('redsocial.form',$redsocial)
    <input type="submit" class="mt-2 btn btn-primary" value="Guardar Red">
    <a href="{{route("red.index")}}" class="btn btn-success mt-2">Regresar</a>
</form>
@endsection