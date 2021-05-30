@csrf
<label for="codaeropuerto" class="text-bold">Codigo del Aeropuerto:</label>
<input id="codaeropuerto" type="text" value="{{ old('codaeropuerto') ?? $vars["aeropuerto"]->codaeropuerto }}" class="form-control" name="codaeropuerto">
<p>{{$errors->first("codaeropuerto")}}</p>

<label for="noma" class="text-bold">Nombre Del Aeropuerto:</label>
<input id="noma" type="text" value="{{ old('nomaeropuerto') ?? $vars["aeropuerto"]->nomaeropuerto }}" class="form-control" name="nomaeropuerto">
<p>{{$errors->first("nomaeropuerto")}}</p>

<label for="nomr" class="text-bold">Nombre del Responsable:</label>
<input id="nomr" type="text" value="{{ old('nomresponsable') ?? $vars["aeropuerto"]->nomresponsable }}" class="form-control" name="nomresponsable">
<p>{{$errors->first("nomresponsable")}}</p>

<label for="pais_id" class="text-bold">Pais :</label>
<select class="form-control" name="pais_id" id="pais">
    <option selected disabled value="">----Seleccionar Pais----</option>    

    @forelse ($vars["pais"] as $pais)
    <option value="{{$pais->id}}" {{$pais->id==$vars["aeropuerto"]->pais_id ? "selected":""}}>{{$pais->nompais}}</option>        
    @empty
    @endforelse
</select>
<p>{{$errors->first("pais_id")}}</p>


<label for="cuidad_id" class="text-bold">Cuidad :</label>
<select class="form-control" name="cuidad_id" id="cuidad">
    <option selected disabled value="">----Seleccionar Cuidad----</option>    

    @forelse ($vars["cuidad"] as $cuidad)
    <option value="{{$cuidad->id}}" {{$cuidad->id==$vars["aeropuerto"]->cuidad_id ? "selected":""}}>{{$cuidad->nomcuidad}}</option>        
    @empty
    
    @endforelse
</select>
<p>{{$errors->first("cuidad_id")}}</p>


<label for="tel" class="text-bold">Telefono:</label>
<input id="tel" type="text" value="{{ old('telefono') ?? $vars["aeropuerto"]->telefono }}" class="form-control" name="telefono">
<p>{{$errors->first("telefono")}}</p>

<label for="numb" class="text-bold">Numero de Bahias:</label>
<input id="numb" type="number" value="{{ old('numbahias') ?? $vars["aeropuerto"]->numbahias }}" class="form-control" name="numbahias">
<p>{{$errors->first("numbahias")}}</p>

@section('scripts')
<script src="/js/aeropuerto.js"></script>
@endsection