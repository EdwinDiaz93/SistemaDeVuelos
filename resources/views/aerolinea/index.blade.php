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
                <th>Acciones</th>
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
              <td>                 
                <a class=" btn btn-block btn-primary" href="{{route("aerolinea.show",$aerolinea->codAeroLinea)}}"><i class="fas fa-eye"></i></a>                
                <a class=" btn btn-block btn-warning my-1" href="{{route("aerolinea.edit",$aerolinea->codAeroLinea)}}"><i class="far fa-edit"></i></a>
                <form method="POST" action="{{route("aerolinea.destroy",$aerolinea->codAeroLinea)}}" >
                  @method("DELETE")                  
                  <button type="submit" class=" btn btn-block btn-danger"><i class="fas fa-trash-alt"></i></button>
                  @csrf
                </form>
              </td>                           
            </tr>          
          </tbody>    
        @empty
            <h2>No hay aero lineas disponibles</h2>
        @endforelse
        
      </table>
@endsection