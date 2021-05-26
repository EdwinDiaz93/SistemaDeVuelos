@extends('layout')

@section('content')
    <h2>Aero Lineas</h2>

    <a class="btn btn-success my-3" href="{{route("aerolinea.create")}}">Crear Aero linea</a> 
    <table class="table">
        <thead>
            <tr>                     
                <th>Codigo Aerolinea</th>
                <th>Nombre de Aerolina</th>
                <th>Nombre Oficial</th>
                <th>Nombre Corto</th>
                <th>Nombre De Representante</th>
                <th>Fecha De Fundacion</th>
            </tr>
        </thead>
        @forelse ($aerolineas as $aerolinea)
          <tbody>
            <tr>                          
              <td>{{$aerolinea->codAeroLinea}}</td>   
              <td>{{$aerolinea->NombreAeroLinea}}</td>   
              <td>{{$aerolinea->NombreOficial}}</td>   
              <td>{{$aerolinea->NombreCorto}}</td>   
              <td>{{$aerolinea->NombreRepresentante}}</td>   
              <td>{{$aerolinea->FechaFundacion}}</td>                           
            </tr>          
          </tbody>    
        @empty
            <h2>No hay aero lineas disponibles</h2>
        @endforelse
        
      </table>
@endsection