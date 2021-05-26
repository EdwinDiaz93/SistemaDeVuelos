@extends('layout')


@section("content")
<form method="POST" action="{{route("red.store")}}">
    @method("POST")

    <h1>Crear red social</h1>
        @include('redsocial.form',$redsocial)
    <input type="submit" class="mt-2 btn btn-primary" value="Guardar Red">
</form>
@endsection