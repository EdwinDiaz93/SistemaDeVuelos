@csrf
<label for="modav" class="text-bold">Modelo De Avion:</label>
<input id="modav" type="text" value="{{ old('modeloavion') ?? $vars["avion"]->modeloavion }}" class="form-control" name="modeloavion">
<p>{{$errors->first("modeloavion")}}</p>

<label for="marcav" class="text-bold">Marca De Avion:</label>
<input id="marcav" type="text" value="{{ old('marcaavion') ?? $vars["avion"]->marcaavion }}" class="form-control" name="marcaavion">
<p>{{$errors->first("marcaavion")}}</p>

<label for="tipoavion_id" class="text-bold">Tipo De Avion:</label>
<select class="form-control" name="tipoavion_id" id="tipoavion">
    <option disabled value="">---Seleccionar un tipo de avion---</option>
    @forelse ($vars["tiposAvion"] as $tipoavion)
    <option value="{{$tipoavion->idtipoavion}}" {{$tipoavion->idtipoavion==$vars["avion"]->tipoavion_id ? "selected":""}}>{{$tipoavion->nombretipoavion}}</option>        
    @empty
        <option selected disabled value="">----No Hay Tipos De Avion Añada Uno----</option>
    @endforelse
</select>
<p>{{$errors->first("tipoavion_id")}}</p>

