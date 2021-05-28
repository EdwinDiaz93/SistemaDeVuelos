@extends('layout')

@section('content')
  <h2>Crear Aeropuertos</h2>
<form action="/aeropuerto" method="POST">
@csrf
<div class="mb-3">
<label for="" class="form-label">Codigo Aeropuerto</label>
<input id="codAeropuerto" name="codAeropuerto" type="text" class="form-control" required>
</div>
<div class="mb-3">
<label for="" class="form-label">Nombre del Aeropuerto</label>
<input id="nomAeropuerto" name="nomAeropuerto" type="text" class="form-control" required>
</div>
<div class="mb-3">
<label for="" class="form-label">Responsable del Aeropuerto</label>
<input id="nomResponsable" name="nomResponsable" type="text" class="form-control" required>
</div>
<div class="mb-3">
<label for="" class="form-label">Telefono del Aeropuerto</label>
<input id="telefono" name="telefono" type="tel"  required class="form-control" >
</div>
<div class="mb-3">
<label for="" class="form-label">Numero de Bahias Aeropuerto</label>
<input id="numBahias" name="numBahias" type="number" class="form-control" required>
</div>

<a href="/aeropuerto" class="btn btn-primary" >Cancelar</a>
<button type="submit" class="btn btn-success">Guardar</button>

</form>

@endsection