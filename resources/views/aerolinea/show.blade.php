@extends('layout')

@section('content')

<h2 class="mt-2">Datos para {{$aerolinea->nombreaerolinea}}</h2>
<div class="row ">
    <div class="col-6">

        <label for="cod" >Codigo Aerolinea:</label>
        <input id="cod" type="text" value="{{$aerolinea->codaerolinea}}" class="form-control" disabled >
                
        <label for="noma" >Nombre Aerolinea:</label>
        <input id="noma" type="text" value="{{$aerolinea->nombreaerolinea}}" class="form-control" disabled >
                
        <label for="nomo" >Nombre Oficial:</label>
        <input id="nomo" type="text" value="{{$aerolinea->nombreoficial}}" class="form-control" disabled >
    </div>

    <div class="col-6">
        <label for="nomc" >Nombre Corto:</label>
        <input id="nomc" type="text" value="{{$aerolinea->nombrecorto}}" class="form-control" disabled >
                
        <label for="nomr" >Nombre Representante:</label>
        <input id="nomr" type="text" value="{{$aerolinea->nombrerepresentante}}" class="form-control" disabled >
                
        <label for="fec" >Fecha De Fundacion:</label>
        <input id="fec" type="date" disabled value="{{$aerolinea->fechafundacion}}" class="form-control" >
    
    </div>
</div>


<h3>Redes Sociales</h3>
<div class="row my-3">       
    @forelse ($aerolinea->redes as $redes)        
    <div class="col-3">
        <p>{{$redes->nombreredsocial}}</p>
    </div>       
    <div class="col-1">
        <label for="">Url:</label>
    </div>
    <div class="col-8">
        <input type="text" disabled class="form-control" value="{{$redes->pivot->url}}" >
    </div>                    
    @empty
        <h3>No hay Redes en esta aerolinea</h3>
    @endforelse
</div>    

<h3>Aviones</h3>
<div class="row my-3">       
    @forelse ($aerolinea->aviones as $avion)        
    <div class="col-3">
        <p>{{$avion->modeloavion}}</p>
    </div>       
    <div class="col-1">
        <label for="">Url:</label>
    </div>
    <div class="col-8">
        <input type="text" disabled class="form-control" value="{{$avion->pivot->cantidad}}" >
    </div>                    
    @empty
        <h3>No hay aviones en esta aerolinea</h3>
    @endforelse
</div>    
    <a class="btn btn-primary" href="{{route("aerolinea.index")}}">Regresar</a>
@endsection