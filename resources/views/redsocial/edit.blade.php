@extends('layout')


@section("content")
<form method="POST" action="{{route("red.update",["redsocial"=>$redsocial->idRedSocial])}}">
    @method("PUT")

    <h1>Crear red social</h1>
        @include('redsocial.form',$redsocial)
        <input type="submit" class="mt-2 btn btn-primary" value="Actualizar Red">
</form>
@endsection