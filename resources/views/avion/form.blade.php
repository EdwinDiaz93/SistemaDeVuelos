@csrf
<label for="modav" class="text-bold">Modelo De Avion:</label>
<input id="modav" type="text" value="{{ old('ModeloAvion') ?? $vars["avion"]->ModeloAvion }}" class="form-control" name="ModeloAvion">
<p>{{$errors->first("ModeloAvion")}}</p>

<label for="marcav" class="text-bold">Marca De Avion:</label>
<input id="marcav" type="text" value="{{ old('MarcaAvion') ?? $vars["avion"]->MarcaAvion }}" class="form-control" name="MarcaAvion">
<p>{{$errors->first("MarcaAvion")}}</p>

<label for="tipoavion_id" class="text-bold">Tipo De Avion:</label>
<select class="form-control" name="tipoavion_id" id="tipoavion">
    @forelse ($vars["tiposAvion"] as $tipoavion)
    <option value="{{$tipoavion->idTipoAvion}}" {{$tipoavion->idTipoAvion==$vars["avion"]->tipoavion_id ? "selected":""}}>{{$tipoavion->NombreTipoAvion}}</option>        
    @empty
        <option selected disabled value="">----No Hay Tipos De Avion Añada Uno----</option>
    @endforelse
</select>
<p>{{$errors->first("tipoavion_id")}}</p>

