@csrf
<label for="nomred" class="text-bold">Nombre Red:</label>
<input id="nomred" type="text" value="{{ old('NombreRedSocial') ?? $redsocial->NombreRedSocial }}" class="form-control" name="NombreRedSocial">
<p>{{$errors->first("NombreRedSocial")}}</p>


