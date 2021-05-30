
@extends('layout')

@section('content')
<div class=" mt-2">
    <h3>Datos para el Aeropuerto {{$vars["aeropuerto"]->nomaeropuerto}}</h3>

    <label for="codA" class="text-bold">Codigo del Aeropuerto:</label>
    <input id="" type="text" value="{{$vars["aeropuerto"]->codaeropuerto }}" class="form-control" disabled>


    <label for="nomA" class="text-bold">Nombre Del Aeropuerto:</label>
    <input id="" type="text" value="{{$vars["aeropuerto"]->nomaeropuerto }}" class="form-control" disabled>
    

    <label for="nomR" class="text-bold">Nombre del Responsable:</label>
    <input id="" type="text" value="{{$vars["aeropuerto"]->nomresponsable }}" class="form-control" disabled>
 
 
    <label for="pais_id" class="text-bold">Pais :</label>
    <select disabled class="form-control">
    <option selected disabled value="">----Seleccionar Pais----</option>    
    @forelse ($vars["pais"] as $pais)
    <option value="{{$pais->id}}" {{$pais->id==$vars["aeropuerto"]->pais_id ? "selected":""}}>{{$pais->nompais}}</option>        
    @empty
    @endforelse
</select>

    <label for="cuidad_id" class="text-bold">Cuidad :</label>
    <select disabled class="form-control">
    <option selected disabled value="">----Seleccionar Cuidad----</option>    
    @forelse ($vars["cuidad"] as $cuidad)
    <option value="{{$cuidad->id}}" {{$cuidad->id==$vars["aeropuerto"]->cuidad_id ? "selected":""}}>{{$cuidad->nomcuidad}}</option>        
    @empty
    @endforelse
</select>

<label for="tel" class="text-bold">Telefono:</label>
<input id="" type="text" value="{{$vars["aeropuerto"]->telefono }}" class="form-control" disabled>


<label for="numB" class="text-bold">Numero de Bahias:</label>
<input id="" type="number" value="{{$vars["aeropuerto"]->numbahias }}" class="form-control" disabled>

    <a href="{{route("aeropuerto.index")}}" class="btn btn-primary mt-2">Regresar</a>
</div>
@endsection


