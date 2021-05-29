@extends('layout')

@section('content')
    <h2>Gestion De Avion</h2>

    <a class="btn btn-success my-3" href="{{route("avion.create")}}">Crear Avion</a>
    <table class="table">
        <thead>
            <tr>                     
                <th>Modelo Avion</th>
                <th>Marca Avion</th>              
                <th>Acciones</th>
            </tr>
        </thead>
        @forelse ($aviones as $avion)
          <tbody>
            <tr>                          
              <td>{{$avion->modeloavion}}</td>   
              <td>{{$avion->marcaavion}}</td>                 
              <td>
                <a class=" btn btn-primary" href="{{route("avion.show",["avione"=>$avion->idavion])}}"><i class="fas fa-eye"></i></a>                
                <a class="btn btn-warning text-white " href="{{route("avion.edit",["avione"=>$avion->idavion])}}"><i class="far fa-edit"></i></a>
                <form class="d-inline-block" action="{{route("avion.destroy",["avione"=>$avion->idavion])}}" method="POST">
                  @method("DELETE")
                  <button type="submit" class="btn btn-danger btn"><i class="fas fa-trash-alt"></i></button>
                  @csrf
                </form>
              </td>           
            </tr>          
          </tbody>    
        @empty
            <h1>No hay aviones disponibles</h1>
        @endforelse
        
      </table>
@endsection