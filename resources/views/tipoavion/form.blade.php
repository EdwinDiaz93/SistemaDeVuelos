@csrf
<label for="nomtip" class="text-bold">Nombre Del Tipo De Avion:</label>
<input id="nomtip" type="text" value="{{ old('NombreTipoAvion') ?? $tipoavion->NombreTipoAvion }}" class="form-control" name="NombreTipoAvion">
<p>{{$errors->first("NombreTipoAvion")}}</p>

<label for="cantip" class="text-bold">Nombre Red:</label>
<input id="cantip" type="number" value="{{ old('CantidadAsientos') ?? $tipoavion->CantidadAsientos }}" class="form-control" name="CantidadAsientos">
<p>{{$errors->first("CantidadAsientos")}}</p>


