@csrf
<div class="row">
    <div class="col-6">

        <label for="cod" >Codigo Aerolinea:</label>
        <input id="cod" type="text" value="{{ old('codaerolinea') ?? $vars["aerolinea"]->codaerolinea }}" class="form-control" name="codaerolinea">
        <p>{{$errors->first("codaerolinea")}}</p>
        
        <label for="noma" >Nombre Aerolinea:</label>
        <input id="noma" type="text" value="{{ old('nombreaerolinea') ?? $vars["aerolinea"]->nombreaerolinea }}" class="form-control" name="nombreaerolinea">
        <p>{{$errors->first("nombreaerolinea")}}</p>
        
        <label for="nomo" >Nombre Oficial:</label>
        <input id="nomo" type="text" value="{{ old('nombreoficial') ?? $vars["aerolinea"]->nombreoficial }}" class="form-control" name="nombreoficial">
        <p>{{$errors->first("nombreoficial")}}</p>
    </div>

    <div class="col-6">
        <label for="nomc" >Nombre Corto:</label>
        <input id="nomc" type="text" value="{{ old('nombrecorto') ?? $vars["aerolinea"]->nombrecorto }}" class="form-control" name="nombrecorto">
        <p>{{$errors->first("nombrecorto")}}</p>
        
        <label for="nomr" >Nombre Representante:</label>
        <input id="nomr" type="text" value="{{ old('nombrerepresentante') ?? $vars["aerolinea"]->nombrerepresentante }}" class="form-control" name="nombrerepresentante">
        <p>{{$errors->first("nombrerepresentante")}}</p>
        
        <label for="fec" >Fecha De Fundacion:</label>
        <input id="fec" type="date" value="{{ old('fechafundacion') ?? $vars["aerolinea"]->fechafundacion }}" class="form-control" name="fechafundacion">
        <p>{{$errors->first("fechafundacion")}}</p>

    </div>
</div>


@if (is_null($vars["aerolinea"]->codaerolinea))    
    <h3>Redes Sociales</h3>
    <p>{{$errors->first("urls")}}</p>
    <div class="row my-3">    
        @forelse ($vars["redes"] as $red)    
            <div class="col-3">
                <p>{{$red->nombreredsocial}}</p>
            </div>       
            <div class="col-1">
                <label for="">Url:</label>
            </div>
            <div class="col-8">
                <input type="text" name="urls[{{$red->idredsocial}}]" class="form-control" value="{{ old("'urls'. [$red->idredsocial]") ?? $red->url}}" >
            </div>               
        @empty
        <strong>No hay Redes sociales listadas</strong>
        <a class="btn ml-3 btn-success" href="{{route("red.create")}}">Añadir una</a>
        @endforelse        
    </div>
    @else
        <div class="row my-3">    
        @forelse ($vars["aerolinea"]->redes as $red)    
            <div class="col-3">
                <p>{{$red->nombreredsocial}}</p>
            </div>       
            <div class="col-1">
                <label for="">Url:</label>
            </div>
            <div class="col-8">
                <input type="text" name="urls[{{$red->idredsocial}}]" class="form-control" value="{{ old("'urls'. [$red->idredsocial]") ?? $red->pivot->url}}" >
            </div>               
        @empty            
        @endforelse        
    </div>
    @endif
    
    @if (is_null($vars["aerolinea"]->codaerolinea))  
    <h3>Aviones</h3>
    <p>{{$errors->first("cantidades")}}</p>
    <div class=" row my-3">    
        @forelse ($vars["aviones"] as $avion)    
            <div class="col-3">
                <p>{{$avion->modeloavion}}</p>
            </div>       
            <div class="col-1">
                <label for="">Cantidad:</label>
            </div>
            <div class="col-8">
                <input type="number" name="cantidades[{{$avion->idavion}}]" class="form-control" value="{{ old("'cantidades'. [$avion->idavion]") ?? $avion->cantidad}}" >
            </div>               
        @empty
        <strong>No hay Aviones listados</strong>
        <a class="btn ml-3 btn-success" href="{{route("avion.create")}}">Añadir uno</a>
        @endforelse        
    </div>
    @else
        <div class="row my-3">    
        @forelse ($vars["aerolinea"]->aviones as $avion)    
            <div class="col-3">
                <p>{{$avion->modeloavion}}</p>
            </div>       
            <div class="col-1">
                <label for="">cantidad:</label>
            </div>
            <div class="col-8">
                <input type="number" name="cantidades[{{$avion->idavion}}]" class="form-control" value="{{ old("'cantidades'. [$avion->idavion]") ?? $avion->pivot->cantidad}}" >
            </div>               
        @empty            
        @endforelse        
    </div>
@endif