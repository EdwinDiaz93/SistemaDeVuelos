
@extends('layout')

@section('content')
<div class=" mt-2">
    <h3>Datos para {{$vars["avion"]->ModeloAvion}}</h3>
    <label for="modav" class="text-bold">Modelo De Avion:</label>
    <input id="modav" disabled type="text" value="{{$vars["avion"]->ModeloAvion }}" class="form-control" >

    <label for="marcav" class="text-bold">Marca De Avion:</label>
    <input id="marcav" disabled type="text" value="{{$vars["avion"]->MarcaAvion }}" class="form-control" >

    <label for="tipoavion_id" class="text-bold">Tipo De Avion:</label>
    <select disabled class="form-control">
        <option selected disabled value="">----Seleccionar Tipo De Avion----</option>    
        @forelse ($vars["tiposAvion"] as $tipoavion)
        <option value="{{$tipoavion->idTipoAvion}}" {{$tipoavion->idTipoAvion==$vars["avion"]->tipoavion_id ? "selected":""}}>{{$tipoavion->NombreTipoAvion}}</option>        
        @empty
        @endforelse
    </select>
    <a href="{{route("avion.index")}}" class="btn btn-primary   mt-2">Regresar</a>
</div>
@endsection
