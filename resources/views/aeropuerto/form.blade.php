@csrf
<label for="codAeropuerto" class="text-bold">Codigo del Aeropuerto:</label>
<input id="codAeropuerto" type="text" value="{{ old('codAeropuerto') ?? $vars["aeropuerto"]->codAeropuerto }}" class="form-control" name="codAeropuerto">
<p>{{$errors->first("codAeropuerto")}}</p>

<label for="nomA" class="text-bold">Nombre Del Aeropuerto:</label>
<input id="nomA" type="text" value="{{ old('nomAeropuerto') ?? $vars["aeropuerto"]->nomAeropuerto }}" class="form-control" name="nomAeropuerto">
<p>{{$errors->first("nomAeropuerto")}}</p>

<label for="nomR" class="text-bold">Nombre del Responsable:</label>
<input id="nomR" type="text" value="{{ old('nomResponsable') ?? $vars["aeropuerto"]->nomResponsable }}" class="form-control" name="nomResponsable">
<p>{{$errors->first("nomResponsable")}}</p>

<label for="pais_id" class="text-bold">Pais :</label>
<select class="form-control" name="pais_id" id="pais">
    <option selected disabled value="">----Seleccionar Pais----</option>    

    @forelse ($vars["pais"] as $pais)
    <option value="{{$pais->id}}" {{$pais->id==$vars["aeropuerto"]->pais_id ? "selected":""}}>{{$pais->nomPais}}</option>        
    @empty
        <option value="">----No Hay Tipos De aeropuerto----</option>
    @endforelse
</select>
<p>{{$errors->first("pais_id")}}</p>


<label for="cuidad_id" class="text-bold">Cuidad :</label>
<select class="form-control" name="cuidad_id" id="cuidad">
    <option selected disabled value="">----Seleccionar Cuidad----</option>    

    @forelse ($vars["cuidad"] as $cuidad)
    <option value="{{$cuidad->id}}" {{$cuidad->id==$vars["aeropuerto"]->cuidad_id ? "selected":""}}>{{$cuidad->nomCuidad}}</option>        
    @empty
        <option value="">----No Hay Tipos De aeropuerto----</option>
    @endforelse
</select>
<p>{{$errors->first("cuidad_id")}}</p>


<label for="tel" class="text-bold">Telefono:</label>
<input id="tel" type="text" value="{{ old('telefono') ?? $vars["aeropuerto"]->telefono }}" class="form-control" name="telefono">
<p>{{$errors->first("telefono")}}</p>

<label for="numB" class="text-bold">Numero de Bahias:</label>
<input id="numB" type="number" value="{{ old('numBahias') ?? $vars["aeropuerto"]->numBahias }}" class="form-control" name="numBahias">
<p>{{$errors->first("codAeropuerto")}}</p>
