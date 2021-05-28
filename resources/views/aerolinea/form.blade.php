@csrf
<div class="row">
    <div class="col-6">

        <label for="cod" >Codigo Aerolinea:</label>
        <input id="cod" type="text" value="{{ old('codAeroLinea') ?? $vars["aerolinea"]->codAeroLinea }}" class="form-control" name="codAeroLinea">
        <p>{{$errors->first("codAeroLinea")}}</p>
        
        <label for="noma" >Nombre Aerolinea:</label>
        <input id="noma" type="text" value="{{ old('NombreAeroLinea') ?? $vars["aerolinea"]->NombreAeroLinea }}" class="form-control" name="NombreAeroLinea">
        <p>{{$errors->first("NombreAeroLinea")}}</p>
        
        <label for="nomo" >Nombre Oficial:</label>
        <input id="nomo" type="text" value="{{ old('NombreOficial') ?? $vars["aerolinea"]->NombreOficial }}" class="form-control" name="NombreOficial">
        <p>{{$errors->first("NombreOficial")}}</p>
    </div>

    <div class="col-6">
        <label for="nomc" >Nombre Corto:</label>
        <input id="nomc" type="text" value="{{ old('NombreCorto') ?? $vars["aerolinea"]->NombreCorto }}" class="form-control" name="NombreCorto">
        <p>{{$errors->first("NombreCorto")}}</p>
        
        <label for="nomr" >Nombre Representante:</label>
        <input id="nomr" type="text" value="{{ old('NombreRepresentante') ?? $vars["aerolinea"]->NombreRepresentante }}" class="form-control" name="NombreRepresentante">
        <p>{{$errors->first("NombreRepresentante")}}</p>
        
        <label for="fec" >Fecha De Fundacion:</label>
        <input id="fec" type="date" value="{{ old('FechaFundacion') ?? $vars["aerolinea"]->FechaFundacion }}" class="form-control" name="FechaFundacion">
    
    </div>
</div>


@if (is_null($vars["aerolinea"]->codAeroLinea))    
    <h3>Redes Sociales</h3>
    <p>{{$errors->first("urls")}}</p>
    <div class="row my-3">    
        @forelse ($vars["redes"] as $red)    
            <div class="col-3">
                <p>{{$red->NombreRedSocial}}</p>
            </div>       
            <div class="col-1">
                <label for="">Url:</label>
            </div>
            <div class="col-8">
                <input type="text" name="urls[{{$red->idRedSocial}}]" class="form-control" value="{{ old("'urls'. [$red->idRedSocial]") ?? $red->url}}" >
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
                <p>{{$red->NombreRedSocial}}</p>
            </div>       
            <div class="col-1">
                <label for="">Url:</label>
            </div>
            <div class="col-8">
                <input type="text" name="urls[{{$red->idRedSocial}}]" class="form-control" value="{{ old("'urls'. [$red->idRedSocial]") ?? $red->pivot->url}}" >
            </div>               
        @empty            
        @endforelse        
    </div>
    @endif
    
    @if (is_null($vars["aerolinea"]->codAeroLinea))  
    <h3>Aviones</h3>
    <p>{{$errors->first("cantidades")}}</p>
    <div class=" row my-3">    
        @forelse ($vars["aviones"] as $avion)    
            <div class="col-3">
                <p>{{$avion->ModeloAvion}}</p>
            </div>       
            <div class="col-1">
                <label for="">Cantidad:</label>
            </div>
            <div class="col-8">
                <input type="number" name="cantidades[{{$avion->idAvion}}]" class="form-control" value="{{ old("'cantidades'. [$avion->idAvion]") ?? $avion->cantidad}}" >
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
                <p>{{$avion->ModeloAvion}}</p>
            </div>       
            <div class="col-1">
                <label for="">cantidad:</label>
            </div>
            <div class="col-8">
                <input type="number" name="cantidades[{{$avion->idAvion}}]" class="form-control" value="{{ old("'cantidades'. [$avion->idAvion]") ?? $avion->pivot->cantidad}}" >
            </div>               
        @empty            
        @endforelse        
    </div>
@endif