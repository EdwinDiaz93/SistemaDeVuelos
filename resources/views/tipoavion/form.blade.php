@csrf
<label for="nomtip" class="text-bold">Nombre Del Tipo De Avion:</label>
<input id="nomtip" type="text" value="{{ old('nombretipoavion') ?? $tipoavion->nombretipoavion }}" class="form-control" name="nombretipoavion">
<p>{{$errors->first("nombretipoavion")}}</p>

<label for="cantip" class="text-bold">Cantidad de asientos:</label>
<input id="cantip" type="number" value="{{ old('cantidadasientos') ?? $tipoavion->cantidadasientos }}" class="form-control" name="cantidadasientos">
<p>{{$errors->first("cantidadasientos")}}</p>


