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
              <td>{{$aerolinea->codaerolinea}}</td>   
              <td>{{$aerolinea->nombreaerolinea}}</td>   
              <td>{{$aerolinea->nombreoficial}}</td>   
              <td>{{$aerolinea->nombrecorto}}</td>   
              <td>{{$aerolinea->nombrerepresentante}}</td>   
              <td>{{$aerolinea->fechafundacion}}</td>                           
              <td>                 
                <a class=" btn btn-block btn-primary" href="{{route("aerolinea.show",$aerolinea->codaerolinea)}}"><i class="fas fa-eye"></i></a>                
                <a class=" btn btn-block btn-warning my-1" href="{{route("aerolinea.edit",$aerolinea->codaerolinea)}}"><i class="far fa-edit"></i></a>
                <form method="POST" action="{{route("aerolinea.destroy",$aerolinea->codaerolinea)}}" >
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