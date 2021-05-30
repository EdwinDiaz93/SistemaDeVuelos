@extends('layout')


@section("content")
<form method="POST" action="{{route("aeropuerto.store")}}">
    @method("POST")

    <h1>Crear Aeropuerto</h1>
        @include('aeropuerto.form',$vars)
    <input type="submit" class="mt-2 btn btn-primary" value="Guardar  Aeropuerto">
    <a href="{{route("aeropuerto.index")}}" class="btn btn-success mt-2">Regresar</a>
</form>
@endsection



@section('scripts')
<script src="/js/aeropuerto.js"></script>
@endsection