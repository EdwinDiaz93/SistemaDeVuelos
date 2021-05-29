@csrf
<label for="nomred" class="text-bold">Nombre Red:</label>
<input id="nomred" type="text" value="{{ old('nombreredsocial') ?? $redsocial->nombreredsocial }}" class="form-control" name="nombreredsocial">
<p>{{$errors->first("nombreredsocial")}}</p>



