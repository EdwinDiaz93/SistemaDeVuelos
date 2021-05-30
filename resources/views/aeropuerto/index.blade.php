@extends('layout')

@section('content')
  <h2>Aeropuertos</h2>

<a class="btn btn-success my-3" href="{{route("aeropuerto.create")}}">Crear Aeropuertos</a> 
    <table class="table mt-4">
        <thead>
            <tr>                     
                <th>Codigo Aeropuerto</th>
                <th>Nombre de Aeropuerto</th>
                <th>Nombre Resaponsable</th>
                <th>Pais</th>
                <th>Cuidad</th>
                <th>Telefono</th>
                <th>Numero de Bahias</th>
                <th>Acciones</th>
            </tr>
        </thead>
        @forelse ($aeropuertos as $aeropuerto)
          <tbody>
            <tr>                          
              <td>{{$aeropuerto->codaeropuerto}}</td>   
              <td>{{$aeropuerto->nomaeropuerto}}</td>   
              <td>{{$aeropuerto->nomresponsable}}</td> 
              <td>{{$aeropuerto->pais_id}}</td>
              <td>{{$aeropuerto->cuidad_id}}</td>
              <td>{{$aeropuerto->telefono}}</td> 
              <td>{{$aeropuerto->numbahias}}</td> 
                           
              <td>                 
                <a class=" btn btn btn-primary" href="{{route("aeropuerto.show",$aeropuerto->codaeropuerto)}}"><i class="fas fa-eye"></i></a>                
                <a class=" btn btn btn-warning my-1" href="{{route("aeropuerto.edit",$aeropuerto->codaeropuerto)}}"><i class="far fa-edit"></i></a>
                <form method="POST" action="{{route("aeropuerto.destroy",$aeropuerto->codaeropuerto)}}">
                  @method("DELETE")  
                <button type="submit"  class=" btn btn btn-danger"><i class="fas fa-trash-alt"></i></button>
        
                  @csrf
                </form>
              </td>                           
            </tr>          
          </tbody>    
        @empty
            <h2>No hay Aeropuertos disponibles</h2>
        @endforelse
        
      </table>
@endsection